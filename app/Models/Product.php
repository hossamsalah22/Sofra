<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'ingredients', 'image', 'price', 'time_to_make', 'offered_price', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

}