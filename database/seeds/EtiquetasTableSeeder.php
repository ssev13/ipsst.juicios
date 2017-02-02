<?php

use Illuminate\Database\Seeder;
use App\Entities\Etiqueta;

class EtiquetasTableSeeder extends Seeder
{

    private function createEtiquetas()
    {

        Etiqueta::create([
            'nombre'   =>'Silla de Ruedas',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Medicamentos',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Cirugía',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Rehabilitación',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Audífonos',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Enfermería',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Hormona',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

        Etiqueta::create([
            'nombre'   =>'Prótesis',
            'detalle'  =>'',
            'estado'   => 'Activo',
        ]);

    }

    public function run()
    {
     	$this->createEtiquetas();
    }
}
