<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
protected $fillable = [
'house_id',
'email',
'message'
];

 public function houses()
    {
        return $this->belongsTo('App\House');
    }
}
