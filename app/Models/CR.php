<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CR extends Model 
{

    protected $table = 'category_resturant';
    public $timestamps = true;
    protected $fillable = array('category_id', 'resturant_id');
}