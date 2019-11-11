<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = [];

    public function hair()
    {
        return $this->hasOne('App\Hair');
    }

    public function makeup()
    {
        return $this->hasOne('App\Makeup');
    }

    public function appointment()
    {
        return $this->hasMany('App\Appointment', 'client_id');
    }
}
