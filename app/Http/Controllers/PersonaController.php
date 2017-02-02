<?php

namespace App\Http\Controllers;

use App\Entities\Persona;
use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class PersonaController extends Controller
{
    public function list(Request $request)
    {

    	if($request->buscar == "") {
    		$personas = Persona::orderBy('DatPerApellidoNombre')->paginate();    		
    	}
    	else {
    		$personas = Persona::busqueda($request->buscar)->orderBy('DatPerApellidoNombre')->paginate();
    	}

        return view('personas.list', compact('personas'));
    }

}
