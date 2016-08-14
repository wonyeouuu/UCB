<?php

namespace App;

use App\Reminder;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    protected $dates = [
        'created_at', 'updated_at', 'alert_at'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public function reminder()
    {
        return $this->belongTo(Reminder::class);
    }

}
