<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'location_id', 
        'participant_id',
        'date'
    ];
    protected $appends = ['hour'];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function getHourAttribute()
    {
        return Carbon::parse($this->date)->format('H:i:s');
    }
}
