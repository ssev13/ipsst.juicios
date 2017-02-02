<?php

namespace App\Http\Controllers;

use App\Entities\Juzgado;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class JuzgadoController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$juzgados = Juzgado::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$juzgados = Juzgado::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('juzgados.list', compact('juzgados'));
    }

    public function create()
    {
        return view('juzgados.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

        $juzgado = Juzgado::create([
            'nombre'        => $request->get('nombre'),
            'detalle'        => $request->get('detalle'),
            'juzgado'		=> 'Activo',
        ]);

        session()->flash('success', 'Juzgado ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$juzgado = Juzgado::findOrFail($id);
        return view('juzgados.edit', compact('juzgado'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:50',
            'detalle'        => 'max:500',
        ]);

    	$juzgado = Juzgado::findOrFail($id);

 		$juzgado->nombre     		= $request->get('nombre');
 		$juzgado->detalle     = $request->get('detalle');

 		$juzgado->save();

        session()->flash('success', 'Juzgado actualizado');

        return Redirect::route('juzgados.list');

    }

    public function delete($id)
    {
    	$juzgado = Juzgado::findOrFail($id);

        $juicios = $juzgado->juicios()->count();

        if($juicios>0){
            session()->flash('danger', 'El juzgado está asignado a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$juzgado->delete();
            session()->flash('success', 'Juzgado eliminado');
        }

        return Redirect()->back();
    }


}
