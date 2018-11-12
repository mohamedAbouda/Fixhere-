<?php

namespace App;

use Illuminate\Database\Eloquent\Model as AppModel;
use Illuminate\Http\UploadedFile;

class Product extends AppModel
{
    protected $fillable = [
        'name', 'description', 'short_description', 'thumbnail', 'views', 'stock', 'model_id', 'price', 'tech_fee', 'is_android_part', 'is_ios_part', 'is_delivery_part'
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
    public function model()
    {
        return $this->belongsTo(Model::class);
    }

    public function brand()
    {
        return $this->model->brand;
    }
}
