<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refer extends Model
{
    protected $table = 'refer';
    protected $fillable = ['user_id','email','phone'];

    public function user()
    {
    	return $this->belongsTo(User::class , 'user_id');
    }
}
