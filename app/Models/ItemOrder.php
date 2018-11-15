<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $table = 'order_items';
    protected $fillable = ['order_id','product_id','qty','price'];

     public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
