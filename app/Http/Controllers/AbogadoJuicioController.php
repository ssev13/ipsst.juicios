<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Entities\Juicio;
use App\Entities\Abogado;
use App\Entities\User;

use Carbon\Carbon;

class AbogadoJuicioController extends Controller
{
    public function submit($id, Request $request)
    {

        $this->validate($request,[
            'matricula'         => 'required',
        ]);

    	$juicio = Juicio::findOrFail($id);

    	$usuario = Abogado::matricula($request->matricula)->get();

        if($usuario->isEmpty()) {
            session()->flash('danger','No se encontro el abogado');
            return redirect()->back();
        }

        session()->flash('success','El abogado fue asignado exitosamente');

//        $juicio->save();

//Grabo un comentario con el alta de usuario
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Abogado Actor',
            'detalle'   => 'Asignacion de abogado a la parte actora',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Abogado Actor',
            'observaciones' => $usuario->first()->nombre,
            'juicio_id' => $id,

        ]);

        $usuario->first()->asignar($juicio);

    	return redirect()->back();
    }

    public function destroy($id, $abogado)
    {

//    	return ('Eliminar abogado');

    	$juicio = Juicio::findOrFail($id);
    	$usuario = Abogado::findOrFail($abogado);

        if (auth()->user()->id != $juicio->user_id) {
            session()->flash('danger','Solo el abogado a cargo puede eliminar un abogado de la parte actora');
            return redirect()->back();
        }

//Grabo un comentario con la baja de usuario
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Abogado Actor',
            'detalle'   => 'Eliminación de abogado a la parte actora',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Abogado Actor',
            'observaciones' => $usuario->nombre,
            'juicio_id' => $id,

        ]);

    	$usuario->desasignar($juicio);

        session()->flash('success','El abogado fue quitado exitosamente');

    	return redirect()->back();
    }
}
