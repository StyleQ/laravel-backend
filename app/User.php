<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
          'email', 'password','name', 'role_id',
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
   {
       $this->attributes['password'] = bcrypt($password);
   }
   protected $table = 'users';



   public function salon()
   {
       return $this->belongsTo('App\Salon');
   }
   public function role()
   {
       return $this->belongsTo('App\Role');
   }

}
