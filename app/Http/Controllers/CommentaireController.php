<?php

namespace App\Http\Controllers;

use App\Models\commentaire;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecommentaireRequest;
use App\Http\Requests\UpdatecommentaireRequest;
use App\Services\CommentaireService;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $CommentaireService;
    public function __construct(CommentaireService $CommentaireService)
    {
        $this->CommentaireService = $CommentaireService;
    }
    public function index()
    {
        return $this->CommentaireService->getAll();

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
    public function store(StorecommentaireRequest $request)
    {
        return $this->CommentaireService->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->CommentaireService->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->CommentaireService->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecommentaireRequest $request, $id)
    {
        return $this->CommentaireService->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->CommentaireService->delete($id);

    }
}
