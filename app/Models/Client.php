<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'password', 'api_token', 'pin_code', 'neighbourhood_id');

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification', 'notificationable');
    }

    public function neighbourhood()
    {
        return $this->belongsTo('App\Models\Neighbourhood');
    }

    public function tokens()
    {
        return $this->morphMany('App\Models\Token', 'tokenable');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    protected $hidden = [
        'password',
        'api_token',
    ];
}
