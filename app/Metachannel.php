<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metachannel extends Model
{
    public function channels()
    {
    	return $this->belongsToMany('App\Channel');
    }
}
