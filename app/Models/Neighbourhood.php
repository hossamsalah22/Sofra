<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Neighbourhood extends Model 
{

    protected $table = 'neighbourhood';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function resturants()
    {
        return $this->hasMany('App\Models\Resturant');
    }

}