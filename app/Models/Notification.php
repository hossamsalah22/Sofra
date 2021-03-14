<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'is_read', 'content', 'order_id', 'notificationable_id', 'notificationable_type');

    public function notificationable()
    {
        return $this->morphTo();
    }

}