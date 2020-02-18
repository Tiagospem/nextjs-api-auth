<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubPost extends Model
{
    protected $guarded = ['id'];

    public function movies(){
        return $this->hasMany(YoutubeUrl::class,  'subpost_id', 'id');
    }

    public function files(){
        return $this->hasMany(File::class,  'subpost_id', 'id');
    }

    public function galeries(){
        return $this->hasMany(Galery::class, 'subpost_id', 'id');
    }
}
