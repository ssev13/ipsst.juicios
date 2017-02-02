<?php

namespace App\Http\Controllers;

use App\Entities\Tipoevento;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TipoeventoController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$tipoeventos = Tipoevento::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$tipoeventos = Tipoevento::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('tipoeventos.list', compact('tipoeventos'));
    }

    public function create()
    {
        return view('tipoeventos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $tipoevento = Tipoevento::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'tipoevento'		=> 'Activo',
        ]);

        session()->flash('success', 'Tipo de evento ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$tipoevento = Tipoevento::findOrFail($id);
        return view('tipoeventos.edit', compact('tipoevento'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$tipoevento = Tipoevento::findOrFail($id);

 		$tipoevento->nombre     		= $request->get('nombre');
 		$tipoevento->detalle     = $request->get('detalle');

 		$tipoevento->save();

        session()->flash('success', 'Tipo de evento actualizado');

        return Redirect::route('tipoeventos.list');

    }

    public function delete($id)
    {
    	$tipoevento = Tipoevento::findOrFail($id);

        $eventos = $tipoevento->eventos()->count();

        if($eventos>0){
            session()->flash('danger', 'El tipo de evento está asignado a '.$eventos.' eventos. No se puede borrar');
        }
        else{
        	$tipoevento->delete();
            session()->flash('success', 'Tipo de evento eliminado');
        }

        return Redirect()->back();
    }



}
