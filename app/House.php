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

    // public static function getByDistance($lat, $lng, $distance)
    // {
    //     $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat . ') ) * sin( radians(latitude) ) ) ) AS distance FROM listings HAVING distance < ' . $distance . ' ORDER BY distance'));
    //     return $results;
    // }
}
