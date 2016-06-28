<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['title','body','due_date', 'privacy','user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
