<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model 
{

    protected $table = 'commissions';
    public $timestamps = true;
    protected $fillable = array('paid', 'payment_date', 'resturant_id', 'notes');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

}