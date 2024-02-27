<?php

namespace App\Http\Controllers;

use App\Models\article;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorearticleRequest;
use App\Http\Requests\UpdatearticleRequest;
use App\Services\ArticleService;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $ArticleService;
    public function __construct(ArticleService $ArticleService)
    {
        $this->ArticleService = $ArticleService;
    }
    public function index()
    {
        return $this->ArticleService->getAll();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorearticleRequest $request)
    {
        return $this->ArticleService->store($request);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->ArticleService->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->ArticleService->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatearticleRequest $request, $id)
    {
        return $this->ArticleService->update($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->ArticleService->delete($id);

    }
}
