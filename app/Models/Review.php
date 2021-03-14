<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model 
{

    protected $table = 'reviews';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'content', 'rate', 'client_id');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}