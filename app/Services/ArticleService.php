<?php

namespace App\Services;

use App\Http\Resources\article\ArticleResource;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class ArticleService
{
    protected $ArticleRepository;
    public function __construct(ArticleRepository $ArticleRepository)
    {
        $this->ArticleRepository =  $ArticleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        return ArticleResource::collection($this->ArticleRepository->getAll());

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $result = ["status" => 200, "message" => "Opération effectuée avec succès."];
        try {
            $dataArticle = $request->only([
                'titre',
                'contenu',
                'category_id'
            ]);
            $image = $request['content'];
            $content = $image->getClientOriginalName();
            $imageName = Str::beforeLast($content, '.');
            $dataArticle['imageName'] = $imageName;
            $dataArticle['content'] = base64_encode(file_get_contents($image));

            $result['data'] = $this->ArticleRepository->save($dataArticle);
            //Save Image in Storage folder

        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'message' =>"erreur lors de l'enregistrement de l'article"
            ];
        }
        return response()->json($result);
    }

    public function show($id)
    {
        return new  ArticleResource($this->ArticleRepository->find($id));

    }

    public function edit($id)
    {
        $article = $this->ArticleRepository->find($id);
        if ($article) {
            return response()->json([
                'status' => 200,
                'articles' => $article
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'messages' => 'Articles Introuvable',
            ], 404);
        }
    }
    public function update(Request $request, $id)
    {

        $articleData = $this->ArticleRepository->find($id);
        $result = [
            'status' => 200,
            'message' => 'Article mis à jour avec succès'
        ];

        if (is_null($articleData)) {
            return response()->json(['message' => "Cette Information  n'existe pas", 'status' => 404]);
        }


        $dataArticle = $request->only(['titre', 'contenu', 'category_id']);
        if ($request->file('content')) {
            // Le contenu est un fichier valide
            $image = $request->file('content');
            $article_image = $image->getClientOriginalName();
            $imageName = Str::beforeLast($article_image, '.');
            $dataArticle['imageName'] = $imageName;
            $dataArticle['content'] = base64_encode(file_get_contents($image));
        } else {
            $dataArticle['content'] = $articleData['content'];
            $dataArticle['imageName'] = $articleData['imageName'];
        }

        $this->ArticleRepository->update($dataArticle, $id);
        $article = $this->ArticleRepository->find($id);// Supposons que 'name' soit le nom de la colonne contenant le libellé de la catégorie
        // Ajouter le libellé de la catégorie à la
        $result['data'] = $article;

        return response()->json($result);
    }


    public function delete($id)
    {
        $article = $this->ArticleRepository->find($id);
        if ($article) {
            $this->ArticleRepository->delete($id);

            return response()->json([
                'status' => 200,
                'messages' => 'Article supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'messages' => 'Article Introuvable',
            ], 404);
        }
    }
}
