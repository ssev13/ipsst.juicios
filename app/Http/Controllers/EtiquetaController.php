<?php

namespace App\Http\Controllers;

use App\Entities\Etiqueta;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EtiquetaController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$etiquetas = Etiqueta::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$etiquetas = Etiqueta::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('etiquetas.list', compact('etiquetas'));
    }

    public function create()
    {
        return view('etiquetas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $etiqueta = Etiqueta::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'estado'		=> 'Activo',
        ]);

        session()->flash('success', 'Etiqueta ingresada');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$etiqueta = Etiqueta::findOrFail($id);
        return view('etiquetas.edit', compact('etiqueta'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$etiqueta = Etiqueta::findOrFail($id);

 		$etiqueta->nombre     		= $request->get('nombre');
 		$etiqueta->detalle     = $request->get('detalle');

 		$etiqueta->save();

        session()->flash('success', 'Etiqueta actualizada');

        return Redirect::route('etiquetas.list');

    }

    public function delete($id)
    {
    	$etiqueta = Etiqueta::findOrFail($id);

        $juicios = $etiqueta->juicios()->count();

        if($juicios>0){
            session()->flash('danger', 'El etiqueta está asignada a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$etiqueta->delete();
            session()->flash('success', 'Etiqueta eliminada');
        }

        return Redirect()->back();
    }

}
