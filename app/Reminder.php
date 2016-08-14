<?php

namespace App;

use App\User;
use App\Alert;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    public static $FREQUENCY_EVERYDAY = 1;
    public static $FREQUENCY_TWICEADAY = 2;
    public static $FREQUENCY_THREETIMESADAY = 3;
    public static $FREQUENCY_FOURTIMESADAY = 4;
    public static $FREQUENCY_THREETIMESAWEEK = 5;
    public static $FREQUENCY_EVERYOTHERDAY = 6;
    public static $FREQUENCY_ONCEINTHREEDAYS = 7;
    public static $FREQUENCY_ONCEAWEEK = 8;
    public static $FREQUENCY_ONCEIN28DAYS = 9;
    
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'start_at', 'end_at'
    ];

    public function setDaysAttribute($value)
    {
        $this->attributes['days'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function setTimesAttribute($value)
    {
        $this->attributes['times'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function user()
    {
        return $this->belongTo(User::Class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
