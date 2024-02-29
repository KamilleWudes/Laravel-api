<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\user\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Models\Role;


class AuthController extends Controller
{

    /**
     * @var $userRepository
     */
    private $userService;

    /**
     * Auth constructor
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Save a user in the db.
     * @param RegisterRequest $request
     * @return the registed user.
     */
    public function register(RegisterRequest $request)
    {
        return $this->userService->save($request);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = JWTAuth::attempt($credentials);
        if ($token) {
            return $this->respondWithToken($token);
        }
        return response()->json(['message' => 'Email ou mot de passe incorrect.'], 401);
    }

    public function logout()
    {
        $cookie = Cookie::forget('token');
        request()->user()->tokens()->delete();
        return response([
            'message' => 'Vous vous êtes déconnecté avec succès.'
        ])->withCookie($cookie);
    }

    public function refresh()
    {
        $newToken = auth()->refresh();
        $cookie = Cookie('token', $newToken, 60 * 1);
        return $this->createNewToken($newToken)->withCookie($cookie);
    }
    /**
     * Get the authenticated User.
     *
     * @return a user profile response
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    /**
     * Create the token.
     *
     * @param  string $token
     *
     * @return an user information in the created token
     */
    protected function respondWithToken($token)
    {
        $cookie = Cookie('token', $token, 20); // 1 hour
        $user = new UserResource(Auth::user());

        // Calcul du temps restant avant l'expiration du token
        $expiresIn = auth()->factory()->getTTL();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn,
            'expires_at' => now()->addMinutes(20)->toISOString(), // Ajout de la clé 'expires_at'
            'user' => $user,
            'role' => $user->getRoleNames(),
        ])->withCookie($cookie);
    }


    /**
     * Get token from cookie httpOnly.
     * @return token otherwise null
     */
    public function retrieveToken()
    {
        $cookie = request()->cookie('token');
        if ($cookie)
            return $cookie;
        else
            return null;
    }

    /**
     * Gets the authenticated
     * @return  the authenticated User
     */
    public function user()
    {
        return Auth::user();
    }


    /**
     * Create the refresh token.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 24 * 7,  // 2 Weeks (getTTL = 120 minutes in jwt config)
        ])->withCookie('token', $token, config('jwt.refresh_ttl'));
    }
}
