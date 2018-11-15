<?php

namespace App;

use Illuminate\Database\Eloquent\Model as AppModel;

class Brand extends AppModel
{
    protected $fillable = [
        'name'
    ];

    /**
     * Relations
     */
     public function models()
     {
         return $this->hasMany(Model::class);
     }
}
