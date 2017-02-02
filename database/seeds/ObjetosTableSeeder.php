<?php

use Illuminate\Database\Seeder;
use App\Entities\Objeto;

class ObjetosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private function createObjetos()
    {

        Objeto::create([
            'nombre'   =>'Amparo',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Objeto::create([
            'nombre'   =>'Cobro',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Objeto::create([
            'nombre'   =>'Daños',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Objeto::create([
            'nombre'   =>'Especiales',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createObjetos();
    }


}
