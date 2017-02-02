<?php

namespace App\Http\Controllers;

use App\Entities\Abogado;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AbogadoController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$abogados = Abogado::orderBy('nombre')->paginate();    		
    	}
    	else {
    		$abogados = Abogado::busqueda($request->buscar)->orderBy('nombre')->paginate();
    	}

        return view('abogados.list', compact('abogados'));
    }

    public function create()
    {
        return view('abogados.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'matricula'     => 'required|unique:abogados,matricula|max:100000',
            'nombre'        => 'required|max:200',
            'observaciones' => 'max:500',
        ]);

        $abogado = Abogado::create([
            'matricula'     => $request->get('matricula'),
            'nombre'        => $request->get('nombre'),
            'observaciones' => $request->get('observaciones'),
        ]);

        session()->flash('success', 'Abogado ingresado');

        return Redirect()->back();

    }


    public function show($id)
    {
    	$abogado = Abogado::findOrFail($id);
        return view('abogados.edit', compact('abogado'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request,[
            'nombre'        => 'required|max:200',
            'observaciones' => 'max:500',
        ]);

    	$abogado = Abogado::findOrFail($id);

 		$abogado->nombre     		= $request->get('nombre');
 		$abogado->observaciones     = $request->get('observaciones');

 		$abogado->save();

        session()->flash('success', 'Abogado actualizado');

        return Redirect::route('abogados.list');

    }

    public function delete($id)
    {
    	$abogado = Abogado::findOrFail($id);

        $juicios = $abogado->juiciosACargo()->count();

        if($juicios>0){
            session()->flash('danger', 'El abogado está asignado a '.$juicios.' juicios. No se puede borrar');
        }
        else{
        	$abogado->delete();
            session()->flash('success', 'Abogado eliminado');
        }

        return Redirect()->back();
    }

}
