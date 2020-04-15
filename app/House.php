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
        'mq',
        'address',
        'img_path',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
