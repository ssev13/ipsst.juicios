<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Juicio;
use App\Entities\Estado;
use App\Entities\Evento;
use App\Entities\Tipoevento;
use App\Entities\FileManager;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class EventoController extends Controller
{
    //

    public function create($id)
    {
        $juicio=Juicio::findOrFail($id);
        $estados=Estado::all();
        $tipoeventos=Tipoevento::all();
        return view('juicios.eventos', compact('juicio','tipoeventos','estados'));
    }

    public function store($id, Request $request)
    {

//        return($request->file('archivo'));

        $juicio = Juicio::findOrFail($id);

        $this->validate($request,[
            'nombre'        => 'required|max:200',
            'detalle'       => 'max:200',
            'fecha'         => 'required|date',
            'vencimiento'   => 'date',
            'observaciones' => 'max:500',
        ]);

        if ($request->get('vencimiento') == '') {
            $vencimiento  = NULL;
        }
        else {
            $vencimiento  = $request->get('vencimiento');
        };

//Reviso si tiene un archivo incluido
        if ($request->file('archivo') == '') {
            $archivo  = NULL;
            $obs=$request->get('obs');
        }
        else {
            $file = $request->file('archivo');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put($file->getFilename().'.'.$file->getClientOriginalName(),  File::get($file));
            $entry = new FileManager();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename().'.'.$file->getClientOriginalName();
            $entry->juicio_id = $id;
            $entry->user_id = auth()->user()->id; 
     
            $entry->save();

            $obs=$request->get('obs').' Archivo: '."<a href='".route('filemanager.get', $file->getFilename().'.'.$file->getClientOriginalName())."'>".$file->getClientOriginalName()."</a>";

            $archivo = $entry->id;

        };

//        return dd($request->get('estadojuicio'));

        if ($juicio->estado_id<>$request->get('estadojuicio')){
            $estadoant = Estado::findOrFail($juicio->estado_id);
            $estado = Estado::findOrFail($request->get('estadojuicio'));
            $juicio->estado_id = $request->get('estadojuicio');
            $obs .= 'Cambio de estado de Juicio de '.$estadoant->nombre.' a '.$estado->nombre;
        }
        $juicio->vencimiento = $vencimiento;
        $juicio->save();

        $usuario = \Auth::user()->id;
        $juicio->eventos()->create([
            'nombre'        => $request->get('nombre'),
            'detalle'       => $request->get('detalle'),
            'fecha'         => $request->get('fecha'),
            'tipoevento_id' => $request->get('tipo'),
            'user_id'       => $usuario,
            'file_id'       => $archivo,
            'vencimiento'   => $vencimiento,
            'observaciones' => $obs,
        ]);

        $hoy = Carbon::now();
        $tipoevento = Tipoevento::findOrFail($request->get('tipo'));

//        return dd($juicio)->get();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Evento',
            'detalle'   => 'Creación de evento',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => $tipoevento->nombre,
            'juicio_id' => $id,
            'observaciones' => $obs,
        ]);

        session()->flash('success', 'Se agregó el evento correctamente!');

//        return Redirect()->back();
        return Redirect::route('juicios.history', $id);
    }

    public function show($id, $evento)
    {
        $juicio=Juicio::findOrFail($id);
        $evento=Evento::findOrFail($evento);
        $tipoeventos=Tipoevento::all();
        return view('juicios.eventos_edit', compact('juicio','evento','tipoeventos'));
    }

    public function update($id, $evento, Request $request)
    {

        $this->validate($request,[
            'nombre'        => 'required|max:200',
            'detalle'       => 'max:200',
            'fecha'         => 'required|date',
            'vencimiento'   => 'date',
            'observaciones' => 'max:500',
        ]);

        $usuario = \Auth::user()->id;
        $juicio = Juicio::findOrFail($id);
        $evento = Evento::findOrFail($evento);

        if ($request->get('vencimiento') == '') {
            $vencimiento  = NULL;
        }
        else {
            $vencimiento  = $request->get('vencimiento');
            $juicio->vencimiento = $vencimiento;
            $juicio->save();
        };

        $evento->nombre         = $request->get('nombre');
        $evento->detalle        = $request->get('detalle');
        $evento->fecha          = $request->get('fecha');
        $evento->vencimiento    = $vencimiento;
        $evento->observaciones  = $request->get('obs');
        $evento->user_id        = $usuario;
        $evento->tipoevento_id  = $request->get('tipo');

        $evento->save();

        session()->flash('success', 'Evento modificado');

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();
        $tipoevento = Tipoevento::findOrFail($request->get('tipo'));

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Mod. Evento',
            'detalle'   => 'Modificacion de evento de un juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Mod. Evento',
            'juicio_id' => $juicio->id,
            'observaciones' => $evento->nombre." - ".$evento->detalle,
        ]);

//        return dd($request->all(),$observaciones);
        return Redirect::route('juicios.history', $id);
    }

    public function delete($id)
    {
        $evento = Evento::findOrFail($id);

        if (auth()->user()->id <> $evento->user_id) {
            session()->flash('danger','Solo el abogado que lo crea puede eliminar un evento');
            return redirect()->back();
        }

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Baja Evento',
            'detalle'   => 'Baja de evento',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Baja Evento',
            'juicio_id' => $evento->juicio_id,
            'observaciones' => $evento->nombre." - ".$evento->detalle,

        ]);
/*
    //Habilitar si se desea eliminar el archivo. Aunque se deberá revisar los historiales para que no muestre el link del archivo que se borra
    
        $file = FileManager::findOrFail($evento->file_id);
        $file->delete();
*/
        $evento->delete();

        session()->flash('success','El evento fue eliminado exitosamente.');

        return redirect()->back();
//        return Redirect::route('juicios.ver_juicio');
//        return dd($id);
    }
}