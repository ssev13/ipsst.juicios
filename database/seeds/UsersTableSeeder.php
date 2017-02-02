<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    private function createAdmin()
    {

        User::create([
            'name'     => 'tecnico',
            'email'    => 'tecnico@ipsst.gov.ar',
            'password' => bcrypt('123'),

            'apellido' => 'Tecnico',
            'nombre'   => 'Usuario',

            'profile'  => 'Tecnico',
            'status'   => 'Activo',
        ]);

        User::create([
            'name'     => 'jefe',
            'email'    => 'jefe@ipsst.gov.ar',
            'password' => bcrypt('123'),

            'apellido' => 'Jefe',
            'nombre'   => 'Usuario',

            'profile'  => 'Jefe',
            'status'   => 'Activo',
        ]);

        User::create([
            'name'     => 'Administrativo',
            'email'    => 'administrativo@ipsst.gov.ar',
            'password' => bcrypt('123'),

            'apellido' => 'Administrativo',
            'nombre'   => 'Usuario',

            'profile'  => 'Administrativo',
            'status'   => 'Activo',
        ]);

        User::create([
            'name'     => 'Profesional',
            'email'    => 'profesional@ipsst.gov.ar',
            'password' => bcrypt('123'),

            'apellido' => 'Profesional',
            'nombre'   => 'Usuario',

            'profile'  => 'Profesional',
            'status'   => 'Activo',
        ]);
        
    }

    public function run()
    {
        $this->createAdmin();
    }

}
