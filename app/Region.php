<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'regions';
    protected $fillable = ['lat','lng','zoom','city_id'];

    public function city()
    {
       return $this->belongsTo('App\City');
    }
}
