<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/sqlsrv123',[
    'as'   => 'juicios.testsql',
    'uses' => 'JuicioController@testsql'
]);
/*
Route::get('/juicios', function () {
    return view('juicios.juicios');
});

Route::get('/abm', function () {
    return view('juicios.juiciosABM');
});

Route::get('/reportes', function () {
    return view('juicios.reportes');
});

*/

Auth::routes();
/*
Route::get('/test/datepicker', function () {
    return view('datepicker4');
});

Route::post('/test/save', ['as' => 'save-date',
       'uses' => 'DateController@showDate', 
        function () {
            return '';
        }]);
*/

Route::get('/stat',[
    'as'   => 'juicios.statsexample',
    'uses' => 'JuicioController@statsexample'
]);


Route::get('/personas',[
    'as'   => 'personas.list',
    'uses' => 'PersonaController@list'
]);
    
//Route::get('pdf', 'PdfController@invoice');
        
Route::group(['middleware' => 'auth'], function(){

///////////MENU
    Route::get('/home',[
        'as'   => 'juicios.panel',
        'uses' => 'JuicioController@panel'
    ]);

    Route::get('/',[
        'as'   => 'juicios.panel',
        'uses' => 'JuicioController@panel'
    ]);

    Route::get('/juicios/{filtro}',[
        'as'   => 'juicios.list',
        'uses' => 'JuicioController@list'
    ]);

    Route::get('/juiciospapelera',[
        'as'   => 'juicios.list_trashed',
        'uses' => 'JuicioController@list_trashed'
    ]);

    Route::get('/estadisticas',[
        'as'   => 'juicios.stats',
        'uses' => 'JuicioController@stats'
    ]);


///Abogados Parte Actora
    Route::get('/paramabogado',[
        'as'   => 'abogados.list',
        'uses' => 'AbogadoController@list'
    ]);

    Route::get('/paramabogadocrear',[
        'as'   => 'abogados.create',
        'uses' => 'AbogadoController@create'
    ]);

    Route::post('/paramabogadocrear',[
        'as'   => 'abogados.store',
        'uses' => 'AbogadoController@store'
    ]);

    Route::get('/paramabogadoeditar/{id}',[
        'as'   => 'abogados.show',
        'uses' => 'AbogadoController@show'
    ]);

    Route::post('/paramabogadoeditar/{id}',[
        'as'   => 'abogados.update',
        'uses' => 'AbogadoController@update'
    ]);

    Route::delete('/paramabogadoeliminar/{id}',[
        'as'   => 'abogados.delete',
        'uses' => 'AbogadoController@delete'
    ]);

///Etiquetas
    Route::get('/parametiqueta',[
        'as'   => 'etiquetas.list',
        'uses' => 'EtiquetaController@list'
    ]);

    Route::get('/parametiquetacrear',[
        'as'   => 'etiquetas.create',
        'uses' => 'EtiquetaController@create'
    ]);

    Route::post('/parametiquetacrear',[
        'as'   => 'etiquetas.store',
        'uses' => 'EtiquetaController@store'
    ]);

    Route::get('/parametiquetaeditar/{id}',[
        'as'   => 'etiquetas.show',
        'uses' => 'EtiquetaController@show'
    ]);

    Route::post('/parametiquetaeditar/{id}',[
        'as'   => 'etiquetas.update',
        'uses' => 'EtiquetaController@update'
    ]);

    Route::delete('/parametiquetaeliminar/{id}',[
        'as'   => 'etiquetas.delete',
        'uses' => 'EtiquetaController@delete'
    ]);

///Estados
    Route::get('/paramestado',[
        'as'   => 'estados.list',
        'uses' => 'EstadoController@list'
    ]);

    Route::get('/paramestadocrear',[
        'as'   => 'estados.create',
        'uses' => 'EstadoController@create'
    ]);

    Route::post('/paramestadocrear',[
        'as'   => 'estados.store',
        'uses' => 'EstadoController@store'
    ]);

    Route::get('/paramestadoeditar/{id}',[
        'as'   => 'estados.show',
        'uses' => 'EstadoController@show'
    ]);

    Route::post('/paramestadoeditar/{id}',[
        'as'   => 'estados.update',
        'uses' => 'EstadoController@update'
    ]);

    Route::delete('/paramestadoeliminar/{id}',[
        'as'   => 'estados.delete',
        'uses' => 'EstadoController@delete'
    ]);

///Tipoeventos
    Route::get('/paramtipoevento',[
        'as'   => 'tipoeventos.list',
        'uses' => 'TipoeventoController@list'
    ]);

    Route::get('/paramtipoeventocrear',[
        'as'   => 'tipoeventos.create',
        'uses' => 'TipoeventoController@create'
    ]);

    Route::post('/paramtipoeventocrear',[
        'as'   => 'tipoeventos.store',
        'uses' => 'TipoeventoController@store'
    ]);

    Route::get('/paramtipoeventoeditar/{id}',[
        'as'   => 'tipoeventos.show',
        'uses' => 'TipoeventoController@show'
    ]);

    Route::post('/paramtipoeventoeditar/{id}',[
        'as'   => 'tipoeventos.update',
        'uses' => 'TipoeventoController@update'
    ]);

    Route::delete('/paramtipoeventoeliminar/{id}',[
        'as'   => 'tipoeventos.delete',
        'uses' => 'TipoeventoController@delete'
    ]);

///Objetos
    Route::get('/paramobjeto',[
        'as'   => 'objetos.list',
        'uses' => 'ObjetoController@list'
    ]);

    Route::get('/paramobjetocrear',[
        'as'   => 'objetos.create',
        'uses' => 'ObjetoController@create'
    ]);

    Route::post('/paramobjetocrear',[
        'as'   => 'objetos.store',
        'uses' => 'ObjetoController@store'
    ]);

    Route::get('/paramobjetoeditar/{id}',[
        'as'   => 'objetos.show',
        'uses' => 'ObjetoController@show'
    ]);

    Route::post('/paramobjetoeditar/{id}',[
        'as'   => 'objetos.update',
        'uses' => 'ObjetoController@update'
    ]);

    Route::delete('/paramobjetoeliminar/{id}',[
        'as'   => 'objetos.delete',
        'uses' => 'ObjetoController@delete'
    ]);

///Juzgados
    Route::get('/paramjuzgado',[
        'as'   => 'juzgados.list',
        'uses' => 'JuzgadoController@list'
    ]);

    Route::get('/paramjuzgadocrear',[
        'as'   => 'juzgados.create',
        'uses' => 'JuzgadoController@create'
    ]);

    Route::post('/paramjuzgadocrear',[
        'as'   => 'juzgados.store',
        'uses' => 'JuzgadoController@store'
    ]);

    Route::get('/paramjuzgadoeditar/{id}',[
        'as'   => 'juzgados.show',
        'uses' => 'JuzgadoController@show'
    ]);

    Route::post('/paramjuzgadoeditar/{id}',[
        'as'   => 'juzgados.update',
        'uses' => 'JuzgadoController@update'
    ]);

    Route::delete('/paramjuzgadoeliminar/{id}',[
        'as'   => 'juzgados.delete',
        'uses' => 'JuzgadoController@delete'
    ]);

///Sentencias
    Route::get('/paramsentencia',[
        'as'   => 'sentencias.list',
        'uses' => 'SentenciaController@list'
    ]);

    Route::get('/paramsentenciacrear',[
        'as'   => 'sentencias.create',
        'uses' => 'SentenciaController@create'
    ]);

    Route::post('/paramsentenciacrear',[
        'as'   => 'sentencias.store',
        'uses' => 'SentenciaController@store'
    ]);

    Route::get('/paramsentenciaeditar/{id}',[
        'as'   => 'sentencias.show',
        'uses' => 'SentenciaController@show'
    ]);

    Route::post('/paramsentenciaeditar/{id}',[
        'as'   => 'sentencias.update',
        'uses' => 'SentenciaController@update'
    ]);

    Route::delete('/paramsentenciaeliminar/{id}',[
        'as'   => 'sentencias.delete',
        'uses' => 'SentenciaController@delete'
    ]);

////////////Reportes
    Route::get('/reportes',[
        'as'   => 'juicios.report',
        'uses' => 'JuicioController@report'
    ]);

    Route::get('/reportesshow',[
        'as'   => 'juicios.report_show',
        'uses' => 'JuicioController@report_show'
    ]);

    Route::get('/juiciopdf/{id}',[
        'as'   => 'pdf.juicio',
        'uses' => 'PdfController@juicio'
    ]);

    Route::post('/reportespdf/{id}',[
        'as'   => 'pdf.report',
        'uses' => 'PdfController@report'
    ]);



///////////JUICIOS

//Buscar Juicios
    Route::get('/juiciobuscar',[
        'as'   => 'juicios.search',
        'uses' => 'JuicioController@search'
    ]);

    Route::get('/juiciovencimientos',[
        'as'   => 'juicios.list_venc',
        'uses' => 'JuicioController@list_venc'
    ]);

//Crear Juicios
    Route::get('/juiciocreate',[
        'as'   => 'juicios.create',
        'uses' => 'JuicioController@create'
    ]);

    Route::post('/juiciocreate',[
        'as'   => 'juicios.store',
        'uses' => 'JuicioController@store'
    ]);

//Modificar Juicios
    Route::get('/juicioedit/{id}',[
        'as'   => 'juicios.show',
        'uses' => 'JuicioController@show'
    ]);

    Route::post('/juicioedit/{id}',[
        'as'   => 'juicios.update',
        'uses' => 'JuicioController@update'
    ]);

//Cambio usuario
    Route::get('/juiciocambiousr/{id}',[
        'as'   => 'juicios.cambiousr',
        'uses' => 'JuicioController@cambiousr'
    ]);

    Route::post('/juiciocambiousr/{id}',[
        'as'   => 'juicios.usr_store',
        'uses' => 'JuicioController@usr_store'
    ]);

//Eliminar Juicio Temporalmente
    Route::get('/juiciodelete/{id}',[
        'as'   => 'juicios.borrar',
        'uses' => 'JuicioController@borrar'
    ]);

//Recuperar Juicio Eliminado Temporalmente
    Route::post('/juiciorecover/{id}',[
        'as'   => 'juicios.recover',
        'uses' => 'JuicioController@recover'
    ]);

//Eliminar Juicio Completamente
    Route::get('/juiciodeletefin/{id}',[
        'as'   => 'juicios.borrarfinal',
        'uses' => 'JuicioController@borrarfinal'
    ]);

//Mostrar Historial
    Route::get('/juiciohistory/{id}/abogado/{abogado?}',[
        'as'   => 'juicios.history',
        'uses' => 'JuicioController@history'
    ]);

//Imprimir Historial
    Route::get('/juicioprint/{id}',[
        'as'   => 'juicios.print',
        'uses' => 'JuicioController@print'
    ]);

//Abogados del actor
    Route::post('/abogados/{id}',[
        'as'   => 'abogados.submit',
        'uses' => 'AbogadoJuicioController@submit'
    ]);

    Route::delete('/abogados/{id}/abogado/{abogado}',[
        'as'   => 'abogados.destroy',
        'uses' => 'AbogadoJuicioController@destroy'
    ]);

//Etiquetas
    Route::post('/etiquetas/{id}',[
        'as'   => 'etiquetas.submit',
        'uses' => 'EtiquetaJuicioController@submit'
    ]);

    Route::delete('/etiquetas/{id}/etiqueta/{etiqueta}',[
        'as'   => 'etiquetas.destroy',
        'uses' => 'EtiquetaJuicioController@destroy'
    ]);

///////////EVENTOS

//Crear Eventos
    Route::get('/event/{id}',[
        'as'   => 'eventos.create',
        'uses' => 'EventoController@create'
    ]);

    Route::post('/event/{id}',[
        'as'   => 'eventos.store',
        'uses' => 'EventoController@store'
    ]);

//Modificar Eventos
    Route::get('/eventedit/{id}/evento/{evento}',[
        'as'   => 'eventos.show',
        'uses' => 'EventoController@show'
    ]);

    Route::post('/eventedit/{id}/evento/{evento}',[
        'as'   => 'eventos.update',
        'uses' => 'EventoController@update'
    ]);

//Eliminar Eventos
    Route::delete('/eventdelete/{id}',[
        'as'   => 'eventos.delete',
        'uses' => 'EventoController@delete'
    ]);


    //Rutas de FileManager
    Route::get('/filemanager',[
        'as'   => 'filemanager.files_index',
        'uses' => 'FileManagerController@index'
    ]);

    Route::get('/getfile/{filename}',[
        'as'   => 'filemanager.get',
        'uses' => 'FileManagerController@get'
    ]);

    Route::post('/addfile/{id}',[
        'as'   => 'filemanager.add',
        'uses' => 'FileManagerController@add'
    ]);

/////ADMIN
    Route::get('/listausr/{id}',[
        'as'   => 'admin.listausr',
        'uses' => 'UserController@list'
    ]);


});

