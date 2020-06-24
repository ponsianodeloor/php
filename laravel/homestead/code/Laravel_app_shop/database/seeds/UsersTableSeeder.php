<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
         'name'=>'Juan ',
         'last_name'=>'Guerrero',
         'email'=>'juan@gmail.com',
         'password'=>bcrypt('juan')
        ]);
    }
}
