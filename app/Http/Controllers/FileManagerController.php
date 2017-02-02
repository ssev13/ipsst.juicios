<?php

namespace App\Http\Controllers;

use App\Entities\FileManager;
use App\Entities\Juicio;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Carbon\Carbon;

class FileManagerController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$entries = FileManager::all();
 
		return view('filemanager.files_index', compact('entries'));
	}
 
	public function add(Request $request, $id) {
 
        $this->validate($request,[
            'filefield'         => 'required',
        ]);		

		$file = $request->filefield;
		$extension = $file->getClientOriginalExtension();
		Storage::disk('local')->put($file->getFilename().'.'.$file->getClientOriginalName(),  File::get($file));
		$entry = new FileManager();
		$entry->mime = $file->getClientMimeType();
		$entry->original_filename = $file->getClientOriginalName();
		$entry->filename = $file->getFilename().'.'.$file->getClientOriginalName();
		$entry->juicio_id = $id;
		$entry->user_id = auth()->user()->id; 
 
		$entry->save();

        //Creo una entrada en el historial
        
        $hoy = Carbon::now();
        $usuario = \Auth::user()->id;

        $juicio = Juicio::findOrFail($id);
        $juicio->eventos()->create([
            'nombre'        => 'Archivo',
            'detalle'       => 'Se agregó un archivo',
            'fecha'         => $hoy,
            'tipoevento_id' => 1,
            'user_id'       => $usuario,
            'vencimiento'   => NULL,
            'observaciones' => "<a href='".route('filemanager.get', $file->getFilename().'.'.$file->getClientOriginalName())."'>".$file->getClientOriginalName()."</a>",
        ]);

        $historial = \Auth::user()->historials()->create([
            'nombre'    => 'Alta Archivo',
            'detalle'   => 'Se agregó un archivo al juicio',
            'estado'    => 'Activo',
            'fecha'     => $hoy,
            'tipo'      => 'Archivo',
            'juicio_id' => $id,
            'observaciones' => "Se agregó un documento. <a href='".route('filemanager.get', $file->getFilename().'.'.$file->getClientOriginalName())."'>".$file->getClientOriginalName()."</a>",
        ]);

        return redirect()->back();
//		return redirect('filemanager.index');
		
	}

	public function get($filename){
	
//		return dd($filename);

		$entry = FileManager::where('filename', '=', $filename)->firstOrFail();
		$file = Storage::disk('local')->get($entry->filename);
 
		return (new Response($file, 200))
              ->header('Content-Type', $entry->mime);
	}	
}
