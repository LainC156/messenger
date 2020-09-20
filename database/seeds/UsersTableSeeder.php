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
            'name' => 'Giovanni Trejo',
            'email' => 'messenger@mail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
