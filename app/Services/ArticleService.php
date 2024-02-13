<?php

namespace App\Services;
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
       $articles = $this->ArticleRepository->getAll();
       if($articles->count() > 0){
        return response()->json([
            "status"=> 200,
            "articles" => $articles,
        ],200);
       }else{
        return response()->json([
            'status' =>404 ,
            'message'=>'Aucune article n’a été trouvée !',
        ],404);

    }
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'titre' => ['required', 'min:3'],
            'contenu'=>['required','min:5'],
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required',
            'user_id' => 'required'    ]);

    // Vérifier s'il y a des erreurs de validation
    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'error' => $validator->errors()->first(),
        ]);
    }
        $result = ["status"=>200 , "message"=>"Opération effectuée avec succès."];

        $imageName = Str::random(32).'.'. $request->image->getClientOriginalExtension();

        
        $dataArticle["titre"] = $request['titre'];
        $dataArticle["contenu"] = $request['contenu'];
        $dataArticle["image"] = $imageName;
        $dataArticle["categorie_id"] = $request['categorie_id'];
        $dataArticle["user_id"] = $request['user_id'];

        try{
            $result['data'] = $this->ArticleRepository->save($dataArticle);
             //Save Image in Storage folder
             Storage::disk('public')->put($imageName, file_get_contents($request->image));

        }catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($result);
    }

    public function show($id)
    {
        $articles = $this->ArticleRepository->find($id);
        if($articles)
        {
            return response()->json([
                'status' => 200,
                'articles'=> $articles
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Article Introuvable',
            ],404);
        }
    }

    public function edit($id)
    {
        $articles = $this->ArticleRepository->find($id);
        if($articles)
        {
            return response()->json([
                'status' => 200,
                'articles'=> $articles
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Articles Introuvable',
            ],404);
        }
    }
    public function update(Request $request, $id) {

        $validator = Validator::make($request->all(), [
            'titre' => ['required', 'min:3'],
            'contenu'=>['required','min:5'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie_id' => 'required',
            'user_id' => 'required'
        ]);
    
        // Vérifier s'il y a des erreurs de validation
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'error' => $validator->errors()->first(),
            ]);
        }
    
        $article = $this->ArticleRepository->find($id);
    
        if (!$article) {
            return response()->json([
                'status' => 404,
                'error' => 'Article introuvable'
            ], 404);
        }
    
        $dataArticle["titre"] = $request['titre'];
        $dataArticle["contenu"] = $request['contenu'];
        $dataArticle["categorie_id"] = $request['categorie_id'];
        $dataArticle["user_id"] = $request['user_id'];
    
        // Vérifier si une nouvelle image est fournie
        if ($request->hasFile('image')) {
            $imageName = Str::random(32).'.'. $request->image->getClientOriginalExtension();
            $dataArticle['image'] = $imageName;
    
            // Enregistrer l'image dans le dossier de stockage
            Storage::disk('public')->put($imageName, file_get_contents($request->image));
        }
    
        try {
            $this->ArticleRepository->update($dataArticle, $id);
            $result = [
                'status' => 200,
                'message' => 'Article mis à jour avec succès'
            ];
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
    
        return response()->json($result);
    }
    

    public function delete($id)
    {
        $articles = $this->ArticleRepository->find($id);
        if($articles)
        {
            $data = $this->ArticleRepository->delete($id);

            return response()->json([
                'status' => 200,
                'messages'=> 'Article supprimé avec succès'
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Article Introuvable',
            ],404);
        }
    }
    
}

