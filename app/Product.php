<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'short_description', 'thumbnail', 'views', 'stock', 'model_id', 'price', 'tech_fee', 'is_android_part', 'is_ios_part', 'is_delivery_part'
    ];

    /**
    * Relations
    */
    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function brand()
    {
        return $this->model()->brand;
    }
}
