<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Video;

class Metachannel extends Model
{
    public function channels()
    {
    	return $this->belongsToMany('App\Channel');
    }

    public function videos()
    {
    	$metachannelId = $this->id;
    	$channelIds = [];
    	foreach ($this->channels as $channel) { $channelIds[] = $channel->id; }

    	return Video::whereIn('channel_id', $channelIds)
    		->orderBy('uploaded_at', 'desc')
    		->get();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
