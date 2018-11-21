<?php

namespace App;

use Illuminate\Database\Eloquent\Model as AppModel;

class MaintenanceService extends AppModel
{
    protected $fillable = [
        'name', 'tech_fee', 'model_id', 'is_android_part', 'is_ios_part', 'is_delivery_part'
    ];

    /**
    * Relations
    */
    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function brand()
    {
        return $this->model->brand;
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'maintenance_service_id');
    }
}
