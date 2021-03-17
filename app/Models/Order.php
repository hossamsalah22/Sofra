<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('resturant_id', 'payment_method_id', 'order_state', 'client_id', 'notes', 'address', 'price', 'total_price', 'delivery', 'commission', 'special_order');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product')->withPivot('price', 'quantity', 'notes');
    }
}
