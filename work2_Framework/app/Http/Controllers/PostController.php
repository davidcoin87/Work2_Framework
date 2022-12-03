<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAll()
    {
        $posts = Post::all()->toArray();
        //dd($posts);
        //dd($posts[0]['name']);

        $postsData = [];

        foreach($posts as $post){
            $categoryName = Category::find($post['category_id'])->name;
            $estado = false;
            if($post["state"] !== 0){
                $estado="Activo";
            }
            //dd($categoryName);
            $newData = [
                "id"=>$post["id"],
                "name"=>$post["name"],
                "description"=>$post['desription'],
                "categoryName"=>$categoryName,
                "estado"=>$estado
            ];
            //dd($newData);
            array_push($postsData, $newData);
            // array_push($postsData, [
            //     "name" => $post["name"],
            //     "categoryName" => $categoryName,
            //     "desription" => $post['description']
            // ]);
            //dd($postsData);
        }
        //dd($postsData);
        return response()->json([
            'error' => '',
            'response' => 'true',
            'result' => $postsData
        ]);
    }

    public function getById($id)
    {
        $post = Post::find($id);
        return response()->json([
            'error' => '',
            'response' => 'true',
            'result' => $post
        ]);
    }

    //enviar como Json para prueba
    public function store(Request $request)
    {
        //print_r($request->all());
        $post = new Post();
        $post->category_id = $request->category_id;
        $post->name = $request->name;
        $post->desription = $request->desription;
        $post->state = $request->state;
        $rta = $post->save();

        //dd($rta);
        //print_r($rta);

        if($rta)
        {
            return response()->json([
                'error' => '',
                'response' => 'true',
                'result' => 'Objeto creado con éxito'
            ]);
        }
    }

    //enviar como Json para prueba
    public function update($id, Request $request)
    {
        //print_r($request->all());
        if($id == $request->id)
        {
            $post = Post::find($id);
            $post->id = $request->id;
            $post->category_id = $request->category_id;
            $post->name = $request->name;
            $post->desription = $request->desription;
            $post->state = $request->state;
            $rta = $post->update();

            //print_r($rta);

            if($rta == 1){
                return response()->json([
                    'error' => '',
                    'response' => 'true',
                    'result' => 'Información actualizada con éxito'
                ]);
            }
            
        }else{
            return response()->json([
                'error' => 'Los campos id no coinciden',
                'response' => 'false',
                'result' => ''
            ]);
        }
    }

    public function destroy($id)
    {
        $rta = Post::destroy($id);

        if($rta == 1){
            return response()->json([
                'error' => '',
                'response' => 'true',
                'result' => 'Registro eliminado con éxito'
            ]);
        } else {
            return response()->json([
                'error' => 'No se pudo eliminar el registro',
                'response' => 'false',
                'result' => ''
            ]);
        }
    }
}
