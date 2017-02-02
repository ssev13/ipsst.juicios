<?php

namespace App\Http\Controllers;

use App\Entities\Objeto;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ObjetoController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$objetos = Objeto::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$objetos = Objeto::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('objetos.list', compact('objetos'));
    }

    public function create()
    {
        return view('objetos.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $objeto = Objeto::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'objeto'		=> 'Activo',
        ]);

        session()->flash('success', 'Objeto ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$objeto = Objeto::findOrFail($id);
        return view('objetos.edit', compact('objeto'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$objeto = Objeto::findOrFail($id);

 		$objeto->nombre     		= $request->get('nombre');
 		$objeto->detalle     = $request->get('detalle');

 		$objeto->save();

        session()->flash('success', 'Objeto actualizado');

        return Redirect::route('objetos.list');

    }

    public function delete($id)
    {
    	$objeto = Objeto::findOrFail($id);

        $juicios = $objeto->juicios()->count();

        if($juicios>0){
            session()->flash('danger', 'El objeto está asignado a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$objeto->delete();
            session()->flash('success', 'Objeto eliminado');
        }

        return Redirect()->back();
    }


}
