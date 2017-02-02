<?php

use Illuminate\Database\Seeder;

class AbogadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function createAbogados()
    {
        $faker = Faker\Factory::create('es_AR');
        DB::table('abogados')->insert([
            'matricula'  => rand(1,9999),
            'nombre' => $faker->lastName.', '.$faker->firstName,
            'observaciones' => $faker->text(),
        ]);
    }

    public function run()
    {
        for ($i = 1; $i <= 20; ++$i) {
	     	$this->createAbogados();
        }     	
    }

}
