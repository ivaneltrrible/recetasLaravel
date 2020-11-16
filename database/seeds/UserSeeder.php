<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear usuarios y perfiles al crear 
        $user = User::create([
            'name' => 'lucio',
            'email' => 'correo@correo.com',
            'password' => Hash::make('rootroot'),
            'url' => 'http://www.google.com',
            ]);
        //$user->perfil()->create();

        $user2 = User::create([
            'name' => 'ivan',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('rootroot'),
            'url' => 'http://www.google.com',
            ]);
        
    }
}
