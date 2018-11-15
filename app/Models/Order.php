<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	  /*
	status 
	* 1 shceduled or sent but not accepted by technical agent yet.
	* 2 send and accepted by technical agent but not completed.
	* 3 send and completed by technical agent
    */
    protected $table = 'orders';
    protected $fillable = ['user_id','total_price','agent_id','status'];

    public function items()
    {
        return $this->hasMany(ItemOrder::class);
    }

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
