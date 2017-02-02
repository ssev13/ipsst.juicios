<?php

namespace App\Http\Controllers;

use App\Entities\Sentencia;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SentenciaController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$sentencias = Sentencia::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$sentencias = Sentencia::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('sentencias.list', compact('sentencias'));
    }

    public function create()
    {
        return view('sentencias.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $sentencia = Sentencia::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'sentencia'		=> 'Activo',
        ]);

        session()->flash('success', 'Sentencia ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$sentencia = Sentencia::findOrFail($id);
        return view('sentencias.edit', compact('sentencia'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$sentencia = Sentencia::findOrFail($id);

 		$sentencia->nombre     		= $request->get('nombre');
 		$sentencia->detalle     = $request->get('detalle');

 		$sentencia->save();

        session()->flash('success', 'Sentencia actualizado');

        return Redirect::route('sentencias.list');

    }

    public function delete($id)
    {
    	$sentencia = Sentencia::findOrFail($id);

        $juicios = $sentencia->juicios()->count();

        if($juicios>0){
            session()->flash('danger', 'El sentencia está asignado a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$sentencia->delete();
            session()->flash('success', 'Sentencia eliminado');
        }

        return Redirect()->back();
    }


}
