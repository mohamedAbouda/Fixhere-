<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestSpellPart extends Model
{
    protected $table = 'request_spells';
    protected $fillable = ['spell_part_id','agent_id','approved'];

    public function agent()
    {
        return $this->belongsTo('App\User','agent_id');
    }
}
