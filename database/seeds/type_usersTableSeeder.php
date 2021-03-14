<?php

use Illuminate\Database\Seeder;
use App\type_users;
class type_usersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $type_users = type_users::create(['name'=>'consultant']);
        $type_users = type_Users::create(['name'=>'salarié']);
     
    
    }
}
