<?php

use Illuminate\Database\Seeder;
use App\Entities\Sentencia;

class SentenciasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createSentencias()
    {

        Sentencia::create([
            'nombre'   =>'Sin Sentencia',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Sentencia::create([
            'nombre'   =>'Casada Sin Resolución',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Sentencia::create([
            'nombre'   =>'Sentencia Firme',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Sentencia::create([
            'nombre'   =>'CSJP',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createSentencias();
    }

}
