<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function reminders()
    {
        return $this->hasMany(Reminder::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function photo()
    {
        return $this->hasOne(Photo::class);
    }
}
