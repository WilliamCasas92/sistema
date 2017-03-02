<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //William
        $user_william = new User();
        $user_william->nombre = 'William';
        $user_william->apellidos = 'Casas Jaramillo';
        $user_william->email = 'william_casas82101@elpoli.edu.co';
        $user_william->save();
        $user_william->roles()->attach(1);

        //Juan
        $user_juan = new User();
        $user_juan->nombre='Juan Carlos';
        $user_juan->apellidos='Osorio Vásquez';
        $user_juan->email='juan_osorio82112@elpoli.edu.co';
        $user_juan->save();
        $user_juan->roles()->attach(2);

        //Roberto
        $user_roberto = new User();
        $user_roberto->nombre='Roberto Antonio';
        $user_roberto->apellidos='Manjarrés Betancur';
        $user_roberto->email='ramanjar@elpoli.edu.co';
        $user_roberto->save();
        $user_roberto->roles()->attach(1);

        //Jaime Montoya
        $user_jaime = new User();
        $user_jaime->nombre='Jaime Alejandro';
        $user_jaime->apellidos='Montoya Brand';
        $user_jaime->email='jamontoya@elpoli.edu.co';
        $user_jaime->save();
        $user_jaime->roles()->attach(1);
    }
}
