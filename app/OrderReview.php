<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderReview extends Model
{
    protected $table = 'order_reviews';
    protected $fillable = ['order_id','rate','review'];
}
