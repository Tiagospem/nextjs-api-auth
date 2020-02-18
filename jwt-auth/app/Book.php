<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $fillable = ['user_id', 'title', 'description'];

    /**
     * Book and User models relationship - Many-to-one
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Book and Rating Models relationship - One-to-many
     */

     public function ratings(){
         return $this->hasMany(Rating::class);
     }
}
