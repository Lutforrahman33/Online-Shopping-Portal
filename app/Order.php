<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable =[
     'user_id',
     'name',
     'phone_number' , 'payment_id' , 'delivery_address' ,'is_paid' ,'transection_id', 'is_completed' , 'is_seenByAdmin'

    ];

    public function user(){

    	return $this->belongsTo('App\User');
    }

    public function payment(){

    	return $this->belongsTo('App\Payment');
    }
}
