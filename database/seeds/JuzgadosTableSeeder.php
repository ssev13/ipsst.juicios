<?php

use Illuminate\Database\Seeder;
use App\Entities\Juzgado;

class JuzgadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createJuzgados()
    {

        Juzgado::create([
            'nombre'   =>'CCA SALA I',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'CCA SALA II',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'CCA SALA III',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC I',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC II',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC III',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC IV',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC V',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC VI',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC VII',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'DOC Y LOC VIII',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Juzgado::create([
            'nombre'   =>'CORTE',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createJuzgados();
    }

}
