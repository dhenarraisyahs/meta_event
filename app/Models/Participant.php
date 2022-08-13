<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = [
        'location_id', 
        'code',
        'name',
        'email',
        'title',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
