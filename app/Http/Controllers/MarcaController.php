<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function setRegistrarMarca(Request $request)
    {
        //Guardar
        $marca = new Marca();
        $marca->create($request->all());

    }
    public function getListarMarca()
    {
        $mar = Marca::all();
        return response()->json($mar);
    }
    public function editMarca(Request $request, $id)
    {
        $mar = Marca::find($id);
        $mar->update($request->all());
    }
    public function delMarca($id)
    {
        $post = Marca::find($id);
        $post->delete();
    }

}
