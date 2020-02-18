<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','active','status','birthday'

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User and Book model relationship - one-to-many
     *
     */

     public function books(){
        return $this->hasMany(Book::class);
     }

     /**
      * implementation of JWTSubject methods
      * return the identifier
      */
      public function getJWTIdentifier()
      {
          return $this->getKey();
      }

      /**
       * implementation of JWTSubject methods
       * allows adding of JWT Claims
       */
      public function getJWTCustomClaims()
      {
          return [];
      }

      /**
       * @param $password
       */
      public function setPasswordAttribute($password)
      {
          if ( !empty($password) ) {
              $this->attributes['password'] = bcrypt($password);
          }
      }
}
