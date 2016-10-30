<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];
    protected $dates = [
        'created_at', 'updated_at', 'date'
    ];

    public function setMriAttribute($value)
    {
        $this->attributes['mri'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function setSymptomAttribute($value)
    {
        $this->attributes['symptom'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getMriAttribute($value)
    {
        return explode(',', $value);
    }

    public function getSymptomAttribute($value)
    {
        return explode(',', $value);
    }

    public function user()
    {
        return $this->belongTo(User::class);
    }
}
