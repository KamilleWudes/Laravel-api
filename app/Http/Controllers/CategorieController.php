<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorecategorieRequest;
use App\Http\Requests\UpdatecategorieRequest;
use Symfony\Component\HttpFoundation\Response;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $categories = categorie::all();
        
    //     if($categories->count()>0){
    //         return response()->json([
    //             'data'=>$categories,
    //             'status'=>200
    //         ],200);
            
    //     }else{
    //         return response()->json([
    //             'message'=>'Aucune donnée n’a été trouvée !',
    //             'status'=>404
    //         ],404);
    //     }
    // }
protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return $this->categoryService->getAll();
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
    public function store(StorecategorieRequest $request)
    {
        return $this->categoryService->save($request);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->categoryService->show($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->categoryService->edit($id);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatecategorieRequest $request, $id)
    {
      return $this->categoryService->updateCategory($request, $id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return $this->categoryService->delete($id);

    }
}
