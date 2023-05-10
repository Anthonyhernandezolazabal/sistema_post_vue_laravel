<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{

    public function getListarClientes()
    {
        $clt = Cliente::all();
        return response()->json($clt);
    }

    public function getDatosPorCliente($id)
    {
        $clt = Cliente::find($id);
        return response()->json($clt);
    }

    public function setRegistrarCliente(Request $request)
    {
        $documento              =   $request->documento;
        $email                  =   $request->email;

        $validarDocumento = DB::select('SELECT documento FROM clientes WHERE documento = ? ',[$documento]);
        $validarEmail = DB::select('SELECT email FROM clientes WHERE email = ? ',[$email]);

        $vDoc = !empty($validarDocumento) ? 1 : 0;
        $vEm = !empty($validarEmail) ? 2 : 0;

        if($vDoc == 1){
            $rpta = 'existeDocumento';
        }else if ($vEm == 2){
            $rpta = 'existeEmail';
        }else{
            $clt = new Cliente();
            $rpta = $clt->create($request->all());
        }

        return $rpta;

    }
    public function delCliente($id){
        $post = Cliente::find($id);
        $post->delete();
    }
    public function cambiarEstadoCliente(Request $request, $id)
    {
        $cat = Cliente::find($id);
        $cat->update($request->all());
    }
    public function editCliente(Request $request, $id)
    {
        $documento              =   $request->documento;
        $email                  =   $request->email;

        $validarDocumento = DB::select('SELECT documento FROM clientes WHERE documento = ? AND id != ? ',[$documento,$id]);
        $validarEmail = DB::select('SELECT email FROM clientes WHERE email = ? AND id != ? ',[$email,$id]);

        $vDoc = !empty($validarDocumento) ? 1 : 0;
        $vEm = !empty($validarEmail) ? 2 : 0;

        if($vDoc == 1){
            $rpta = 'existeDocumento';
        }else if ($vEm == 2){
            $rpta = 'existeEmail';
        }else{
            $clt = Cliente::find($id);
            $rpta = $clt->update($request->all());
        }
        return $rpta;

    }
}
