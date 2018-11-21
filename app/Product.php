<?php

namespace App;

use Illuminate\Database\Eloquent\Model as AppModel;
use Illuminate\Http\UploadedFile;

class Product extends AppModel
{
    protected $fillable = [
        'name', 'description', 'short_description', 'thumbnail', 'views', 'stock', 'price', 'maintenance_service_id'
    ];
    protected $appends = [
        'thumbnail_url'
    ];

    public $upload_distination = '/uploads/images/';

    /**
    * Accessors & Mutators
    */
    public function setThumbnailAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['thumbnail'] = $value;
            return;
        }
        $file_name = str_random(60);
        $file_name = $file_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$file_name);
        $this->attributes['thumbnail'] = $file_name;
    }

    public function getThumbnailUrlAttribute()
    {
        return asset($this->upload_distination.$this->thumbnail);
    }

    /**
    * Relations
    */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function maintenanceService()
    {
        return $this->belongsTo(MaintenanceService::class);
    }
}
