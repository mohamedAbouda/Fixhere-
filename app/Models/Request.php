<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    /*
	status 
	* 1 shceduled or sent but not accepted by technical agent yet.
	* 2 send and accepted by technical agent but not completed.
	* 3 send and completed by technical agent
    * 4 canceled by technical agent
    */
    protected $fillable = ['agent_id','user_id','status','spell_part','price'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Product','spell_part');
    }
}
