<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'message' ,'from' ,'to' , 'group' ,'title' ,'type'
    ];

    /**
    * Relations
    */
    public function fromUser()
    {
        return $this->belongsTo(User::class,'from');
    }
    public function toUser()
    {
        return $this->belongsTo(User::class,'to');
    }
}
