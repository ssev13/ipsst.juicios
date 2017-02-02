<?php

use Illuminate\Database\Seeder;
use App\Entities\Juicio;

class JuiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function createJuicios()
    {
        $faker = Faker\Factory::create('es_AR');
        DB::table('juicios')->insert([
            'causa'  => $faker->sentence(2),
            'expediente' => $faker->sentence(2),
            'objeto'  => $faker->sentence(),
            'observaciones' => $faker->text(),
            'vencimiento' => $faker->dateTimeBetween('now', '1 week'),
            'user_id' => rand(1, 3),
            'juzgado_id' => rand(1, 5),
            'estado_id' => rand(1, 8),
            'sentencia_id' => rand(1, 4),
            'asunto_id' => rand(1, 4),
        ]);
    }

    public function run()
    {
        for ($i = 1; $i <= 300; ++$i) {
	     	$this->createJuicios();
        }     	
    }

}
