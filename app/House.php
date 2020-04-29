<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id',
        'room_number',
        'bed',
        'bathroom',
        'description',
        'mq',
        'address',
        'img_path',
        'status',
        'latitude',
        'longitude'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function extras() 
    {
        return $this->belongsToMany('App\Extra');
    }
    public function messages()
    {
        return $this->hasMany('App\Message');
    }
    public function sponsors()
    {
        return $this->belongsToMany('App\Sponsor')->withTimestamps();
    }
}
