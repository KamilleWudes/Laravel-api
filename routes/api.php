<?php

use App\Http\Controllers\api\auth\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentaireController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('auth', 'login');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');


Route::group(['middleware' => ['auth']], function () {

        Route::get('user', [AuthController::class, 'user']);
        Route::get('user-profile', [AuthController::class, 'userProfile']);
        Route::get('token', [AuthController::class, 'retrieveToken']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('refresh', [AuthController::class, 'refresh']);

});
//Route Categories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
//Route::get('/categories/{id}',[CategorieController::class, 'edit'])->name('EditCategorie');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

//Route Users

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
//Route::get('/users/{id}', [UserController::class, 'edit'])->name('EditUser');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//Route Articles
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
//Route::get('/articles/{id}', [ArticleController::class, 'edit'])->name('Editarticle');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

//Route comment
Route::get('/comments', [CommentaireController::class, 'index'])->name('comment.index');
Route::post('/comments', [CommentaireController::class, 'store'])->name('comment.store');
Route::get('/comments/{id}', [CommentaireController::class, 'show'])->name('comment.show');
Route::get('/comments/{id}', [CommentaireController::class, 'edit'])->name('comment.edit');
Route::put('/comments/{id}', [CommentaireController::class, 'update'])->name('comment.update');
Route::delete('/comments/{id}', [CommentaireController::class, 'destroy'])->name('comment.destroy');
