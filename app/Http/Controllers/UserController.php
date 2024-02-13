<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreusersRequest;
use App\Http\Requests\UpdateusersRequest;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $UserService;
    public function __construct(UserService $UserService)
    {
        $this-> UserService = $UserService;
    }
    public function index()
    {
        return $this->UserService->getAll();

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreusersRequest $request)
    {
        return $this->UserService->save($request);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->UserService->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return $this->UserService->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateusersRequest $request, string $id)
    {
        return $this->UserService->update($request , $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->UserService->delete($id);

    }
}
