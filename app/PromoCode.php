<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
    protected $table = 'promo_codes';
    protected $fillable = ['code','value','is_valid','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }
}
