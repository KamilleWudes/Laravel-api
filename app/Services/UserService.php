<?php

namespace App\Services;
use Exception;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserService
{
    protected $UserRepository;
    public function __construct(UserRepository $UserRepository)
    {
        $this->UserRepository = $UserRepository;
    }
    public function getAll()
    {
        $users = $this->UserRepository->getAll();
        if($users->count()>0)
        {
            return response()->json([
                'status' => 200,
                'users'=> $users
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'message'=>'Aucune users n’a été trouvée !',
            ],404);
        }
    }

    public function save(Request $request) {
        $result = ["status"=>200 , "message"=>"Opération effectuée avec succès."];
        
        $dataUser["name"] = $request['name'];
        $dataUser["prenom"] = $request['prenom'];
        $dataUser["email"] = $request['email'];
        $dataUser["password"] = $request['password'];


        try{
            $result['data'] = $this->UserRepository->save($dataUser);
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
        $users = $this->UserRepository->find($id);
        if($users)
        {
            return response()->json([
                'status' => 200,
                'users'=> $users
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'message'=>'Users Introuvable',
            ],404);
        }
    }

    public function edit($id)
    {
        $users = $this->UserRepository->find($id);
        if($users)
        {
            return response()->json([
                'status' => 200,
                'users'=> $users
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'message'=>'Users Introuvable',
            ],404);
        }
    }

    public function update(Request $request, string $id)
    {
        $users = $this->UserRepository->find($id);
        if($users)
        {
            $data = $this->UserRepository->update($request->all(),$id);

            return response()->json([
                'status' => 200,
                'messages'=> 'Mise à jour effectuée avec succès'
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Users Introuvable',
            ],404);
        }
    }

    public function delete($id)
    {
        $users = $this->UserRepository->find($id);
        if($users)
        {
            $data = $this->UserRepository->delete($id);

            return response()->json([
                'status' => 200,
                'messages'=> 'User supprimé avec succès'
            ],200);

        }else{
            return response()->json([
                'status' =>404 ,
                'messages'=>'Users Introuvable',
            ],404);
        }
    }
    
}

