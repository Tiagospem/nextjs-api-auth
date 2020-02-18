<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function replies(){
        return $this->hasMany(Comment::class);
    }

    public function movies(){
        return $this->hasMany(YoutubeUrl::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }

    public function galeries(){
        return $this->hasMany(Galery::class);
    }

    public function subpost(){
        return $this->hasMany(SubPost::class);
    }
}
