<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Http\UploadedFile;
use DB;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lat', 'lng', 'location', 'cover_image',
        'cost_per_hour', 'rate', 'description', 'contact_number', 'profile_image','parent_id',
        'social_id' ,'social_type','card_pan','card_type','card_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'profile_image_url' , 'cover_image_url'
    ];

    public $upload_distination = '/uploads/images/';

    /**
    * Accessors & Mutators
    */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function setProfileImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['profile_image'] = $value;
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['profile_image'] = $image_name;
    }

    public function getProfileImageUrlAttribute()
    {
        return asset($this->upload_distination.$this->profile_image);
    }

    public function setCoverImageAttribute($value)
    {
        if (!$value instanceof UploadedFile) {
            $this->attributes['cover_image'] = $value;
            return;
        }
        $image_name = str_random(60);
        $image_name = $image_name.'.'.$value->getClientOriginalExtension(); // add the extention
        $value->move(public_path($this->upload_distination),$image_name);
        $this->attributes['cover_image'] = $image_name;
    }

    public function getCoverImageUrlAttribute()
    {
        return asset($this->upload_distination.$this->cover_image);
    }

    public function getByDistance($lat, $lng, $distance)
    {
        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM users HAVING distance < ' . $distance . ' ORDER BY distance') );

        return $results;
    }

    /**
     * Relations
     */
}
