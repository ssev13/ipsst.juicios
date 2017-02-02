<?php

namespace App\Http\Controllers;

use App\Entities\Estado;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EstadoController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$estados = Estado::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$estados = Estado::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('estados.list', compact('estados'));
    }

    public function create()
    {
        return view('estados.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $estado = Estado::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'estado'		=> 'Activo',
        ]);

        session()->flash('success', 'Estado ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$estado = Estado::findOrFail($id);
        return view('estados.edit', compact('estado'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$estado = Estado::findOrFail($id);

 		$estado->nombre     		= $request->get('nombre');
 		$estado->detalle     = $request->get('detalle');

 		$estado->save();

        session()->flash('success', 'Estado actualizado');

        return Redirect::route('estados.list');

    }

    public function delete($id)
    {
    	$estado = Estado::findOrFail($id);

        $juicios = $estado->juicios()->count();

        if($juicios>0){
            session()->flash('danger', 'El estado está asignado a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$estado->delete();
            session()->flash('success', 'Estado eliminado');
        }

        return Redirect()->back();
    }


}
