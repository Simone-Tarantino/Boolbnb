<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUS extends Model
{

    public $table = 'contactus';

    public $fillable = 
    [
        'house_id',
        'email',
        'message'
    ];
}
