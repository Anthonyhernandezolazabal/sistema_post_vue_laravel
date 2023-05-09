<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    public function setRegistrarCategoria(Request $request)
    {
        //Guardar
        $categoria = new Categoria();
        $categoria->create($request->all());

    }
    public function getListarCategoria()
    {
        // $posts = Categoria::all()->toArray();
        // return array_reverse($posts);
        $cat = Categoria::all();
        return response()->json($cat);
    }
    public function editCategoria(Request $request, $id)
    {
        $cat = Categoria::find($id);
        $cat->update($request->all());
    }
    public function delCategoria($id)
    {
        $post = Categoria::find($id);
        $post->delete();
    }
}
