<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class ProductImage extends Model
{
    protected $fillable = [
        'image'
    ];
    protected $appends = [
        'image_url'
    ];

    public $upload_distination = '/uploads/images/';

    /**
    * Accessors & Mutators
    */
    public function setImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['image'] = $value;
            return;
        }
        $file_name = str_random(60);
        $file_name = $file_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$file_name);
        $this->attributes['image'] = $file_name;
    }

    public function getImageUrlAttribute()
    {
        return asset($this->upload_distination.$this->image);
    }
}
