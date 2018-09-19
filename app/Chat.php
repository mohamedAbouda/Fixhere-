<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    const SENDER_TYPE_ADMIN = 'admin';
    const SENDER_TYPE_AGENT = 'agent';
    const SENDER_TYPE_CLIENT = 'client';

    protected $fillable = [
        'message' ,'order_id' ,'sender_id' ,'sender_type'
    ];

    /**
    * Relations
    */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }
}
