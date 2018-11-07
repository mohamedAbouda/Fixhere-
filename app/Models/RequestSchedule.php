<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSchedule extends Model
{
     protected $table = 'request_schedule';
    protected $fillable = ['request_id','day_date','day_time','sent_times','approved'];
}
