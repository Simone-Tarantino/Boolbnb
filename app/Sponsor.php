<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'duration',
        'price'
    ];

     public function houses()
    {
        return $this->belongsToMany('App\House')->withTimestamps();
    }
}
