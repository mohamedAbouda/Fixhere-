<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSchedule extends Model
{
	protected $table = 'request_schedule';
	/*
	* 0 shceduled but not approved
	* 1 sent and approved by technical agent
	*/
	protected $fillable = ['request_id','day_date','day_time','sent_times'];
	protected $dates = ['day_date'];


	public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
