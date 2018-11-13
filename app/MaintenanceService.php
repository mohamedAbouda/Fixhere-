<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceService extends Model
{
    protected $fillable = [
        'name', 'tech_fee'
    ];
}
