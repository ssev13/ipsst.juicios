<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TipoEventosTableSeeder::class);
//        $this->call(TipoHonorariosTableSeeder::class);
        $this->call(JuzgadosTableSeeder::class);
        $this->call(EstadosTableSeeder::class);
        $this->call(SentenciasTableSeeder::class);
        $this->call(ObjetosTableSeeder::class);
        $this->call(AbogadosTableSeeder::class);
        $this->call(EtiquetasTableSeeder::class);
//        $this->call(JuiciosTableSeeder::class);
    }
}
