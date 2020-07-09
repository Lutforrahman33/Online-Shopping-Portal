<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $fillable =[
     'name',
     'image' , 'short_name' , 'priority' ,'no' ,'type'

    ];
}
