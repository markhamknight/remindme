<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function reminder()
    {
        return $this->belongsTo(Reminder::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
