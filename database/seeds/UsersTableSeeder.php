<?php

use Illuminate\Database\Seeder;
use App\type_users;
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
   
        $user = User::create([

            'name'=>'Admin',
            'email' =>'admin@gmail.com',
            'password'=> bcrypt('admin'),
            'type_users' => 'admin',
        ]);
    }
}
