<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
     protected $fillable = [
        'name'
    ];

    public function houses() 
    {
        return $this->belongsToMany('App\House');
    }
}
