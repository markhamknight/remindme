<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function reminder()
    {
        return $this->hasMany(Reminder::class);
    }
}
