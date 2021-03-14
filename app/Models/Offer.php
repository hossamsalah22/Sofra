<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'start_at', 'end_at', 'resturant_id');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}