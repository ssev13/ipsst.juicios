<?php

namespace App\Http\Controllers;

use App\Entities\User;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function list($id, Request $request)
    {

        if($id == "juicios"){

            if($request->buscar == "") {

                $usuarios = User::leftJoin('juicios', 'users.id', '=', 'juicios.user_id')
                    ->selectRaw('users.*, count(juicios.id) as CantJuicios')
                    ->orderBy('CantJuicios','desc')
                    ->groupBy('users.id')
                    ->paginate();
            }
            else{
                $usuarios = User::busqueda($request->buscar)
                    ->leftJoin('juicios', 'users.id', '=', 'juicios.user_id')
                    ->selectRaw('users.*, count(juicios.id) as CantJuicios')
                    ->orderBy('CantJuicios','desc')
                    ->groupBy('users.id', 'users.name')
                    ->paginate();                
            }
        }
        
        else{

        	if($request->buscar == "") {
        		$usuarios = User::orderBy($id)
                    ->paginate();

        	}
        	else {
        		$usuarios = User::busqueda($request->buscar)
                    ->orderBy($id)
                    ->paginate();
        	}

        }

        return view('admin.listausr', compact('id','usuarios'));
    }


}
