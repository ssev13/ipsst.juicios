<?php

use Illuminate\Database\Seeder;
use App\Entities\TipoEvento;

class TipoEventosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createTipoEventos()
    {

        TipoEvento::create([
            'nombre'   =>'Archivos',
            'detalle'  =>'Se suben archivos al servidor',
            'estado'   => 'Activo',
        ]);

        TipoEvento::create([
            'nombre'   =>'Notificaciones a la oficina',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        TipoEvento::create([
            'nombre'   =>'Cédulas casillero',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);


        TipoEvento::create([
            'nombre'   =>'Honorarios',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createTipoEventos();
    }

}
