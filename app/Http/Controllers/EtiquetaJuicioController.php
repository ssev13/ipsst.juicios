<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Entities\Juicio;
use App\Entities\Etiqueta;
use App\Entities\User;

use Carbon\Carbon;

class EtiquetaJuicioController extends Controller
{
    public function submit($id, Request $request)
    {

        $this->validate($request,[
            'etiquetaid'         => 'required',
        ]);

    	$juicio = Juicio::findOrFail($id);

    	$usuario = Etiqueta::etiquetaid($request->etiquetaid)->get();

        if($usuario->isEmpty()) {
            session()->flash('danger','No se encontro la etiqueta');
            return redirect()->back();
        }

        session()->flash('success','La etiqueta fue asignada exitosamente');

//        $juicio->save();

//Grabo un comentario con el alta de usuario
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Etiquetado',
            'detalle'   => 'Asignacion de etiqueta',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Etiqueta',
            'observaciones' => $usuario->first()->nombre,
            'juicio_id' => $id,

        ]);

        $usuario->first()->asignar($juicio);

    	return redirect()->back();
    }

    public function destroy($id, $etiqueta)
    {

//    	return ('Eliminar etiqueta');

    	$juicio = Juicio::findOrFail($id);
    	$usuario = Etiqueta::findOrFail($etiqueta);

/*
        if (auth()->user()->id != $juicio->user_id) {
            session()->flash('danger','Solo el abogado a cargo puede eliminar una etiqueta');
            return redirect()->back();
        }
*/

//Grabo un comentario con la baja de usuario
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Etiqueta',
            'detalle'   => 'Eliminación de etiqueta',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Etiqueta',
            'observaciones' => $usuario->nombre,
            'juicio_id' => $id,

        ]);

    	$usuario->desasignar($juicio);

        session()->flash('success','La etiqueta fue quitada exitosamente');

    	return redirect()->back();
    }
}
