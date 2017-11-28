<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function metachannels()
    {
    	return $this->belongsToMany('App\Metachannels');
    }

    public function videos()
    {
    	return $this->hasMany('App\Video');
    }
}
