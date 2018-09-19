<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id' ,'technician_id' ,'service_id' ,'region_id','description' ,
        'lat' ,'lng' ,'payment_method','value'
        ,'status' //0 => recieved , 1 => accepted , 2 => agent on the way , 3 => done
    ];

   
    /**
     * Relations
     */
     public function service()
     {
         return $this->belongsTo(Service::class , 'service_id');
     }

    public function region()
     {
         return $this->belongsTo(Region::class);
     }

     public function technician()
     {
         return $this->belongsTo(User::class , 'technician_id');
     }

     public function client()
     {
         return $this->belongsTo(User::class , 'user_id');
     }

    public function pickup()
     {
         return $this->hasMany(PickupDate::class);
     }

      public function reviews()
     {
         return $this->hasMany(OrderReview::class);
     }
}
