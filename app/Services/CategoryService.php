<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Validator;
use App\Models\categorie;


class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $categories = $this->categoryRepository->getAll();
        if ($categories->count() > 0) {
            return response()->json([
                'data' => $categories,
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'Aucune donnée n’a été trouvée !',
                'status' => 404
            ], 404);
        }
    }

    public function save(Request $request)
    {

        $result = ['status' => 200, 'message' => "Categorie créé avec succès"];

        $catData['libelle'] = $request['libelle'];

        try {
            $result['data'] = $this->categoryRepository->save($catData);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function show($id)
    {
        $categorie = $this->categoryRepository->find($id);
        if ($categorie) {

            return response()->json(
                [
                    'status' => 200,
                    'categorie' => $categorie
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'messages' => 'categorie Introuvable'
                ],
                404
            );
        }
    }

    public function edit($id)
    {
        $categorie = $this->categoryRepository->find($id);
        if ($categorie) {

            return response()->json(
                [
                    'status' => 200,
                    'categorie' => $categorie
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'messages' => 'categorie Introuvable'
                ],
                404
            );
        }
    }

    public function updateCategory(Request $request, string $id)
    {

        $categorie = $this->categoryRepository->find($id);

        if ($categorie) {
             $this->categoryRepository->update($request->all(), $id);
            $result['data'] = $this->categoryRepository->find($id);
            return response()->json([
                'status' => 200,
                'message' => 'Mise a jour categorie réussie',
                'data' => $result['data'],

            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'messages' => 'categorie Introuvable'
            ], 404);
        }
    }

    public function delete($id)
    {
        $categorie = $this->categoryRepository->find($id);
        if ($categorie) {
            $data = $this->categoryRepository->delete($id);

            return response()->json(
                [
                    'status' => 200,
                    'messages' => 'Categorie supprimé',
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'status' => 404,
                    'messages' => 'categorie Introuvable'
                ],
                404
            );
        }
    }
}
