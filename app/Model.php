<?php

namespace App;

use Illuminate\Database\Eloquent\Model as AppModel;

class Model extends AppModel
{
    protected $fillable = [
        'name', 'brand_id'
    ];

    /**
    * Relations
    */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function maintenanceServices()
    {
        return $this->hasMany(MaintenanceService::class);
    }
}
