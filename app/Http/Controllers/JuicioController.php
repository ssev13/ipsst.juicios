<?php

namespace App\Http\Controllers;

use Response;
use App\Entities\User;
use App\Entities\Juicio;
use App\Entities\Juzgado;
use App\Entities\Estado;
use App\Entities\Objeto;
use App\Entities\Sentencia;
use App\Entities\Abogado;
use App\Entities\Etiqueta;

use App\Entities\Evento;
use App\Entities\Tipoevento;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class JuicioController extends Controller
{

    public function create()
    {
        $objetos = Objeto::all();
        $estados = Estado::all();
        $juzgados = Juzgado::all();
        $sentencias = Sentencia::all();

        return view('juicios.create', compact('objetos','estados','juzgados','sentencias','abogados'));
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'causa'         => 'required|unique:juicios,causa|max:200',
            'expediente'    => 'required|unique:juicios,expediente|max:200',
            'descripcion'   => 'required|max:200',
            'fecha'         => 'required',
            'observaciones' => 'max:500',
            'vencimiento'   => 'date',
        ]);

        $juzgado   = Juzgado::findOrFail($request->get('juzgado'));
        $estado    = Estado::findOrFail($request->get('estado'));
        $sentencia = Sentencia::findOrFail($request->get('sentencia'));
        $objeto    = Objeto::findOrFail($request->get('objeto'));

        if ($request->get('vencimiento') == '') {
            $vencimiento  = NULL;
        }
        else {
            $vencimiento  = $request->get('vencimiento');
        };


        $juicio = \Auth::user()->juicios()->create([
            'causa'         => $request->get('causa'),
            'expediente'    => $request->get('expediente'),
            'expteipsst'    => $request->get('expteipsst'),
            'descripcion'   => $request->get('descripcion'),
            'observaciones' => $request->get('observaciones'),
            'fecha'         => $request->get('fecha'),
            'vencimiento'   => $vencimiento,
            'juzgado_id'    => $juzgado->id,
            'estado_id'     => $estado->id,
            'sentencia_id'  => $sentencia->id,
            'objeto_id'     => $objeto->id,
        ]);

        session()->flash('success', 'Juicio creado');

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Alta',
            'detalle'   => 'Alta de juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Alta',
            'juicio_id' => $juicio->id,
        ]);

        return Redirect()->back();
//        return Redirect::route('juicios.juiciosABM');
    }

    public function show($id)
    {
        $juicios = Juicio::findOrFail($id);

//        return dd($id);

        $objetos = Objeto::all();
        $estados = Estado::all();
        $juzgados = Juzgado::all();
        $sentencias = Sentencia::all();

        return view('juicios.edit', compact('juicios','objetos','estados','juzgados','sentencias'));
    }

    public function update($id, Request $request)
    {

        $this->validate($request,[
            'causa'         => 'required|max:200',
            'descripcion'   => 'required|max:200',
            'observaciones' => 'max:500',
        ]);

        $juicio = Juicio::findOrFail($id);
        $observaciones = '';

        $juzgado   = Juzgado::findOrFail($request->get('juzgado'));
        $estado    = Estado::findOrFail($request->get('estado'));
        $sentencia = Sentencia::findOrFail($request->get('sentencia'));
        $objeto    = Objeto::findOrFail($request->get('objeto'));

        if (! $request->get('vencimiento')) {
            $vencimiento  = NULL;
        }
        else {
            $vencimiento  = $request->get('vencimiento');
        };

        if ($juicio->causa  != $request->get('causa')) {
            $observaciones .= "Causa: ".$juicio->causa." -> ".$request->get('causa')." - ";
        }

        if ($juicio->expteipsst  != $request->get('expteipsst')) {
            $observaciones .= "Expte IPSST: ".$juicio->expteipsst." -> ".$request->get('expteipsst')." - ";
        }

        if ($juicio->descripcion  != $request->get('descripcion')) {
            $observaciones .= "Descripcion: ".$juicio->descripcion." -> ".$request->get('descripcion')." - ";
        }

        if ($juicio->observaciones  != $request->get('observaciones')) {
            $observaciones .= "observaciones: ".$juicio->observaciones." -> ".$request->get('observaciones')." - ";
        }

        if ($juicio->fecha  != $request->get('fecha')) {
            $observaciones .= "fecha: ".$juicio->fecha." -> ".$request->get('fecha')." - ";
        }

        if ($juicio->vencimiento  != $request->get('vencimiento')) {
            $observaciones .= "vencimiento: ".$juicio->vencimiento." -> ".$request->get('vencimiento')." - ";
        }

        if ($juicio->juzgado_id  != $request->get('juzgado')) {
            $juzgado_nombre = Juzgado::findOrFail($juicio->juzgado_id);
            $observaciones .= "juzgado: ".$juzgado_nombre->nombre." -> ".$juzgado->nombre." - ";
        }

        if ($juicio->estado_id  != $request->get('estado')) {
            $estado_nombre = Estado::findOrFail($juicio->estado_id);
            $observaciones .= "estado: ".$estado_nombre->nombre." -> ".$estado->nombre." - ";
        }

        if ($juicio->sentencia_id  != $request->get('sentencia')) {
            $sentencia_nombre = Sentencia::findOrFail($juicio->sentencia_id);
            $observaciones .= "sentencia: ".$sentencia_nombre->nombre." -> ".$sentencia->nombre." - ";
        }

        if ($juicio->objeto_id  != $request->get('objeto')) {
            $objeto_nombre = Objeto::findOrFail($juicio->objeto_id);
            $observaciones .= "objeto: ".$objeto_nombre->nombre." -> ".$objeto->nombre." - ";
        }

        $juicio->causa          = $request->get('causa');
        $juicio->juzgado_id     = $request->get('juzgado');
        $juicio->expteipsst     = $request->get('expteipsst');
        $juicio->objeto_id      = $request->get('objeto');
        $juicio->descripcion    = $request->get('descripcion');
        $juicio->estado_id      = $request->get('estado');
        $juicio->sentencia_id   = $request->get('sentencia');
        $juicio->fecha          = $request->get('fecha');
        $juicio->vencimiento    = $vencimiento;
        $juicio->observaciones  = $request->get('observaciones');

        $juicio->save();

        session()->flash('success', 'Juicio modificado');

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Modificacion',
            'detalle'   => 'Modificacion de juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Modificacion',
            'juicio_id' => $juicio->id,
            'observaciones' => $observaciones,
        ]);

//        return dd($request->all(),$observaciones);
//        return Redirect::route('juicios.list');
        return Redirect::route('juicios.history', $id);
    }

    public function cambiousr($id)
    {
        $juicios = Juicio::findOrFail($id);

//        return dd($juicios->juzgado()->first()->nombre);
      $usuarios = User::where('profile','Profesional')->get();

        return view('juicios.edit_usr', compact('juicios','objetos','estados','juzgados','sentencias','usuarios'));
    }

    public function usr_store($id, Request $request)
    {

        $this->validate($request,[
            'usuario'   => 'required',
        ]);

        $abogado = User::findOrFail($request->get('usuario'));
        $juicio = Juicio::findOrFail($id);
        $observaciones = 'Cambio de abogado: '.$juicio->user()->first()->nombreComun.' -> '.$abogado->nombreComun;

        $juicio->user_id  = $request->get('usuario');
        $juicio->save();

        session()->flash('success', 'Cambio de abogado exitoso!!!');

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Abogado',
            'detalle'   => 'Cambio de Encargado',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Abogado',
            'juicio_id' => $juicio->id,
            'observaciones' => $observaciones,
        ]);

//        return dd($request->all(),$observaciones);
//        return Redirect::route('juicios.list');
        return Redirect::route('juicios.history', $id);
    }

    public function search(Request $request)
    {
        $this->validate($request,[
            'busqueda'   => 'required',
        ]);

        $juicios = Juicio::withTrashed()->busqueda($request->busqueda)->paginate();
        return view('juicios.juicios', compact('juicios'));

    }

    public function list($filtro)
    {
        if ($filtro=='null'){    
            $juicios = Juicio::paginate();
        }
        else{
            $juicios = Juicio::abogado($filtro)->paginate();
        }

        return view('juicios.juicios', compact('juicios'));
    }

    public function list_trashed()
    {
        $juicios = Juicio::onlyTrashed()->paginate();
        return view('juicios.juicios', compact('juicios'));
    }

    public function list_venc()
    {

        $date = new Carbon('next monday');
        $juicios = Juicio::where('vencimiento','<',$date)->paginate();

//        $juicios = Juicio::juicios_vencidos()->paginate();
        return view('juicios.juicios', compact('juicios'));
    }

    public function report()
    {
        $abogados = User::where('profile','Profesional')->get();
        $objetos = Objeto::all();
        $estados = Estado::all();
        $juzgados = Juzgado::all();
        $sentencias = Sentencia::all();
        $tipoeventos = Tipoevento::all();
        $usuario =  \Auth::user();
        $vencimiento_hasta = new Carbon('next monday');

//        return dd($usuario->id);
        return view('juicios.reportes', compact('abogados','objetos','estados','juzgados','sentencias','tipoeventos',
            'usuario','vencimiento_hasta'));
    }

    public function report_show(Request $request)
    {
        $this->validate($request,[
/*
            'fecha_desde'   => 'required',
            'fecha_hasta'   => 'required',

            'vence_desde'   => 'required',
            'vence_hasta'   => 'required',
*/
        ]);

        $resultados = Juicio::fecha($request->fecha_desde, $request->fecha_hasta)
            ->vence($request->vence_desde, $request->vence_hasta)
            ->abogado($request->abogado)
            ->descripcion($request->descripcion)
            ->juzgado($request->juzgado)
            ->objeto($request->objeto)
            ->estado($request->estado)
            ->sentencia($request->sentencia);
        $tipoevento= $request->tipoevento;

        if ($tipoevento) {
            $resultados=$resultados->whereHas('eventos', function($q) use($tipoevento) { $q->where('tipoevento_id', $tipoevento); });
        }

        $cantidad = $resultados->count();
        $resultados = $resultados->paginate();

        return view('juicios.reportes_table', compact('resultados','cantidad', 'request'));
    }

    public function panel()
    {

        $date = new Carbon('next monday');

        $usuario=auth()->user()->id;
        $usuarios=User::count();

        $juicioxabog=Juicio::where('user_id',$usuario)
            ->count();
    	$juicios=Juicio::count();

        $juiciovencexabog=Juicio::where('user_id',$usuario)
            ->where('vencimiento','<=',$date)
            ->count();
        $juiciosvencidos=Juicio::where('vencimiento','<',$date)->count();
//        $juiciosvencidos=Juicio::JuiciosVencidos();

        $vencimientos=Juicio::where('user_id',$usuario)
            ->where('vencimiento','<=',$date)
            ->orderBy('vencimiento')->paginate(10);

        return view('juicios.panel', compact('usuarios','juicios','juiciosvencidos','vencimientos','juicioxabog','juiciovencexabog'));
    }

    public function borrar($id)
    {
        $juicio = Juicio::findOrFail($id);

        if (auth()->user()->id <> $juicio->user_id and auth()->user()->profile<>'Jefe') {
            session()->flash('danger','Solo el abogado a cargo o el abogado jefe puede cerrar el juicio');
            return redirect()->back();
        }

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Cierre',
            'detalle'   => 'Cierre de juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Cierre',
            'juicio_id' => $id,

        ]);

        $juicio->delete();

        session()->flash('success','El juicio fue cerrado exitosamente.');

//        return Redirect::route('juicios.list');
        return Redirect::route('juicios.history', $id);        
    }

    public function borrarfinal($id)
    {

        $juicio = Juicio::onlyTrashed()->findOrFail($id);

        if (auth()->user()->profile <> 'Tecnico') {
            session()->flash('danger','Solo un Administrador del Sistema puede eliminar un juicio');
            return redirect()->back();
        }

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Eliminación',
            'detalle'   => 'Baja física de juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Eliminación',
            'juicio_id' => $id,
        ]);
        
        $juicio->forceDelete();

        session()->flash('success','El juicio fue eliminado exitosamente.');

        return Redirect::route('juicios.list_trashed');
    }

    public function recover($id)
    {
        $juicios = Juicio::withTrashed()->findOrFail($id);
        $juicios->restore();

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Reapertura',
            'detalle'   => 'Reapertura de juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Reapertura',
            'juicio_id' => $id,

        ]);


        $juicios = Juicio::paginate();

        session()->flash('success','El juicio se reabrió exitosamente.');
        return redirect()->back();
    }

    public function history($id)
    {
        $juicio=Juicio::withTrashed()->findOrFail($id);

        $etiquetas = $juicio->etiquetas()->get();

        $etiquetasfalta = Etiqueta::whereDoesntHave('juicios', function($q) use ($id){
            $q->where('juicio_id', $id);
        })->get();

        $eventos = Evento::where('juicio_id',$juicio->id)->get();
        $historials = $juicio->historials()->get();
        $abogados = Abogado::all();

//        return dd($eventos);
        return view('juicios.ver_juicio', compact('juicio','eventos','historials','abogados','etiquetas','etiquetasfalta'));
    }

    public function stats()
    {
        //Asigno el array vacío para que no salte error si no hay registros
        $abogados = User::all();
        if (! $abogados) {
            $torta1[]= array('label' => 'Vacio', 'data' => 0);
        }
        foreach($abogados as $abogado) {
            if ($abogado->juicios()->count()>0){
                $torta1[] = array('label' => $abogado->name,
                            'data' => $abogado->juicios()->count());
            }
        }

        $etiquetas = Etiqueta::all();
        if ($etiquetas->count() == 0) {
            $label1[]= array('label' => 'Vacio', 'data' => 0);            
        }
        foreach($etiquetas as $etiqueta) {
            if ($etiqueta->juicios()->count()>0){
                $label1[] = array('label' => $etiqueta->nombre,
                            'data' => $etiqueta->juicios()->count());
            }
        }

        $objetos = Objeto::all();
        if (! $objetos) {
            $torta2[]= array('label' => 'Vacio', 'data' => 0);            
        }
        foreach($objetos as $objeto) {
            if ($objeto->juicios()->count()>0){
                $torta2[] = array('label' => $objeto->nombre.' - '.$objeto->juicios()->count(),
                            'data' => $objeto->juicios()->count());
            }
        }

        $tipoeventos = Tipoevento::all();
        if (! $tipoeventos) {
            $torta3[]= array('label' => 'Vacio', 'data' => 0);            
        }
        foreach($tipoeventos as $tipoevento) {
            if ($tipoevento->eventos()->count()>0){
                $torta3[] = array('label' => $tipoevento->nombre.' - '.$tipoevento->eventos()->count(),
                            'data' => $tipoevento->eventos()->count());
            }
        }

//        return dd($torta3);
        return view('juicios.charts', compact('torta1','label1','torta2','torta3'));
    }

    public function help()
    {
//        return dd('hola');
        $filename = 'ayuda.pdf';
        $path = ''.$filename; //storage_path($filename);

        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);

//        return view('ayuda.ayuda');
    }

    public function statsexample()
    {
//        return dd($torta1);
        return view('juicios.chartsexam', compact('torta1','torta2'));
    }
    public function testsql()
    {
//        return dd('hola');
        return view('testsql');
    }
}
