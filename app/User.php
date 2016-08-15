<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Record;
use App\Reminder;

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

    public function records()
    {
        return $this->hasMany(Record::class);
    }
}
