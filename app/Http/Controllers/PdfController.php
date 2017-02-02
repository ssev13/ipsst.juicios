<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Entities\Juicio;
use App\Entities\Evento;
use App\Entities\Historial;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function report(Request $request, $id) 
    {

		$products = Juicio::fecha($request->fecha_desde, $request->fecha_hasta)
            ->vence($request->vence_desde, $request->vence_hasta)
            ->abogado($request->abogado)
            ->descripcion($request->descripcion)
            ->juzgado($request->juzgado)
            ->objeto($request->objeto)
            ->estado($request->estado)
            ->sentencia($request->sentencia)->get();
        $cantidad = $products->count();
        $date = date('Y-m-d');
        $usuario = \Auth::user()->nombreCompleto;

        $view =  \View::make($id, compact('products', 'date', 'cantidad','usuario'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        return $pdf->stream('invoice');
//		return $pdf->download('invoice');        

    }

    public function juicio($id) 
    {

        $juicio=Juicio::withTrashed()->findOrFail($id);
        $eventos = Evento::where('juicio_id',$juicio->id)->get();
        $historials = $juicio->historials()->get();

        $usuario = \Auth::user()->nombreCompleto;

        $view =  \View::make('pdf.juiciopdf', compact('juicio','eventos','historials'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper('a4', 'landscape');

        return $pdf->stream('invoice');
//      return $pdf->download('invoice');        

    }

}
