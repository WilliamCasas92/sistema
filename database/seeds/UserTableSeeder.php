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
        $user_william->nombre='William';
        $user_william->apellidos='Casas Jaramillo';
        $user_william->email='william_casas82101@elpoli.edu.co';
        $user_william->save();

        //Juan
        $user_juan = new User();
        $user_juan->nombre='Juan Carlos';
        $user_juan->apellidos='Osorio Vásquez';
        $user_juan->email='juan_osorio82112@elpoli.edu.co';
        $user_juan->save();

    }
}
