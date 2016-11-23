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
    
    public static $ENUM_STATUS = [
        'PENDING' => 1,
        'TRIGGERED' => 2,
    ];

    public function reminder()
    {
        return $this->belongsTo(Reminder::class);
    }

}
