<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'service_type' ,'center_id' ,'agent_id' ,'order_date' ,'time_from' ,
        'time_to' ,'lat' ,'lng' ,'problem' ,'status' ,'client_id'
    ];

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
