<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'from_id'=> 1,
            'to_id' => 2,
            'content' => '¿hola cómo estás?'
        ]);
        Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'content' => 'bien ¿y tú cómo estás?'
        ]);

        Message::create([
            'from_id'=> 1,
            'to_id' => 3,
            'content' => 'hola, saludos'
        ]);
        Message::create([
            'from_id' => 3,
            'to_id' => 1,
            'content' => 'saludos desde aquí'
        ]);
        Message::create([
            'from_id'=> 1,
            'to_id' => 3,
            'content' => 'yo te regreso los saludos ;)'
        ]);
    }
}
