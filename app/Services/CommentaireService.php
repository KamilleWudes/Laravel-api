<?php

namespace App\Services;

use Illuminate\Http\Request;
use Exception;
use App\Repositories\CommentaireRepository;


class CommentaireService
{
    protected $CommentRepository;
    public function __construct(CommentaireRepository $CommentRepository)
    {
        $this->CommentRepository =  $CommentRepository;
    }

    public function getAll()
    {
       $Comments = $this->CommentRepository->getAll();
       if($Comments->count() > 0){
        return response()->json([
            "status"=> 200,
            "Comments" => $Comments,
        ],200);
       }else{
        return response()->json([
            'status' =>404 ,
            'message'=>'Aucune Comment n’a été trouvée !',
        ],404);

    }
}

public function store(Request $request) {
    $result = ["status"=>200 , "message"=>"Opération effectuée avec succès."];
    
    $dataComment["pseudo"] = $request['pseudo'];
    $dataComment["commentaire"] = $request['commentaire'];
    $dataComment["article_id"] = $request['article_id'];


    try{
        $result['data'] = $this->CommentRepository->save($dataComment);
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
        $Comments = $this->CommentRepository->find($id);
        if($Comments)
        {
            return response()->json([
                'status' => 200,
                'Comments'=> $Comments
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Comments Introuvable',
            ],404);
        }
    }

    public function edit($id)
    {
        $Comments = $this->CommentRepository->find($id);
        if($Comments)
        {
            return response()->json([
                'status' => 200,
                'Comments'=> $Comments
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Comments Introuvable',
            ],404);
        }
    }

    public function update(Request $request, string $id)
    {
        $comments = $this->CommentRepository->find($id);
        if($comments)
        {
            $data = $this->CommentRepository->update($request->all(),$id);

            return response()->json([
                'status' => 200,
                'messages'=> 'Mise à jour effectuée avec succès'
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'comment Introuvable',
            ],404);
        }
    }

    public function delete($id)
    {
        $comments = $this->CommentRepository->find($id);
        if($comments)
        {
            $data = $this->CommentRepository->delete($id);

            return response()->json([
                'status' => 200,
                'messages'=> 'comment supprimé avec succès'
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'comment Introuvable',
            ],404);
        }
    }
}
