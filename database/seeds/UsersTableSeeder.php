<?php

use App\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Giovanni_Trejo',
            'email' => 'messenger@mail.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'messenger1@mail.com',
            'password' => bcrypt('secret'),
        ]);
        User::create([
            'name' => 'Juan Carlos',
            'email' => 'messenger2@mail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
