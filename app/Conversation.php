<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $appends = [
        'contact_name',
    ];

    public function getContactNameAttribute() {
        return $this->contact()->first(['name'])->name;
    }

    public function contact(){
            /* relation Conversation N to 1 with User(contact) */
        return $this->belongsTo(User::class);
    }
}
