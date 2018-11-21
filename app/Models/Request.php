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
    protected $fillable = ['agent_id','user_id','status','service_id','price'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }

    public function service()
    {
        return $this->belongsTo('App\MaintenanceService','service_id');
    }
}
