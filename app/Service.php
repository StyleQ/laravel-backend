<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
      protected $guarded = [];

      public function salon()
      {
          return $this->belongsTo('App\Salon');
      }
}
