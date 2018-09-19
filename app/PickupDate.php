<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PickupDate extends Model
{
    protected $table = 'pickup_date';
    protected $fillable = ['order_id','date'];
    protected $dates = ['date'];
}
