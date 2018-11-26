<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCode extends Model
{
	/*
	* discount type
	1 - Percentage
	2 - Flat amount
	*/
    protected $table = 'promo_codes';
    protected $fillable = ['code','value','is_valid','user_id','discount_type','start_date','end_date','description','number_of_usage'];
    protected $dates = ['start_date','end_date'];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }
}
