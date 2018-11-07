<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentReview extends Model
{
	protected $table = 'agent_reviews';
	protected $fillable = ['agent_id','user_id','rate','review'];

	public function user()
	{
		return $this->belongsTo('App\User','user_id');
	}

	public function agent()
	{
		return $this->belongsTo('App\User','agent_id');
	}
}
