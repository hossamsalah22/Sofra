<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model 
{

    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'image', 'deliver', 'min_charge', 'status', 'email', 'phone', 'password', 'api_token', 'pin_code', 'neighbourhood_id', 'whats_num', 'resturant_phone');

    public function commissions()
    {
        return $this->hasMany('App\Models\Commission');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function neighbourhood()
    {
        return $this->belongsTo('App\Models\Neighbourhood');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

}