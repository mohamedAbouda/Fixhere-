<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_type' ,'center_id' ,'agent_id' ,'client_id','order_date' ,
        'time_from' ,'time_to' ,'lat' ,'lng' ,'problem'
        ,'status' //0 => recieved , 1 => accepted , 2 => agent on the way , 3 => done
    ];

    /**
    * Accessors & Mutators
    */
    public function getTimeFromAttribute()
    {
        $exploded_time = explode(':', $this->attributes['time_from']);
        return $exploded_time[0].':'.$exploded_time[1];
    }
    public function getTimeToAttribute()
    {
        $exploded_time = explode(':', $this->attributes['time_to']);
        return $exploded_time[0].':'.$exploded_time[1];
    }

    /**
     * Relations
     */
     public function center()
     {
         return $this->belongsTo(User::class , 'center_id');
     }

     public function agent()
     {
         return $this->belongsTo(User::class , 'agent_id');
     }

     public function client()
     {
         return $this->belongsTo(User::class , 'client_id');
     }
}
