<?php

use Illuminate\Database\Seeder;
use App\Entities\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createEstados()
    {

        Estado::create([
            'nombre'   =>'Abierto a Pruebas',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Alegatos',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Sentencia',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Casación',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Contestación de Sentencia',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Fallecimiento actor',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Paralizado',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Estado::create([
            'nombre'   =>'Archivado',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createEstados();
    }
}
