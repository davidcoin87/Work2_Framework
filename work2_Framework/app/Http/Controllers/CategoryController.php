<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAll()
    {
        $categories = Category::all()->toArray();
        return response()->json([
            'error' => '',
            'response' => 'true',
            'result' => $categories
        ]);
    }

    public function getById($id)
    {
        $category = Category::find($id);
        return response()->json([
            'error' => '',
            'response' => 'true',
            'result' => $category
        ]);
    }

    //enviar como Json para prueba
    public function store(Request $request)
    {
        //print_r($request->all());
        $newCategory = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $rta = Category::create($newCategory);

        if($rta->id > 0)
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
        if($id == $request->id)
        {
            $rta = Category::find($id)->update($request->all());

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
        $rta = Category::destroy($id);

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
