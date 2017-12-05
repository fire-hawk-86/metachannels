<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	 /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'uploaded_at'
    ];

    public function channel()
    {
    	return $this->belongsTo('App\Channel');
    }
}
