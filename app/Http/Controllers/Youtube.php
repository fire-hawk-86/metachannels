<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class Youtube extends Controller
{
    public function video($id)
    {
    	$related_videos = YoutubeApi::request('search', [
    		'part'              => 'snippet',
            'maxResults'        => 25,
            'relatedToVideoId'  => $id,
            'type'              => 'video',
    	]);

        $vid = YoutubeApi::request('videos', [
            'id'    => $id,
            'part'  => 'snippet',
        ]);

        // make links clickable in description
        $description = $vid->items[0]->snippet->description;
        $description = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $description);
        $vid->items[0]->snippet->description = $description;

        return view('youtube.video', [
            'id' => $id,
            'related_videos' => $related_videos,
            'vid' => $vid->items[0]
        ]);
    }

    public function search_get()
    {
    	$query = Input::get('query');
        return redirect("search/$query");
    }

    public function search($query)
    {
    	$obj = YoutubeApi::request('search', [
            'part'              => 'snippet',
            'maxResults'        => 16,
            'q'                 => $query,
            'type'              => 'video',
        ]);

        return view('youtube.search', [
            'result' => $obj,
            'query' => $query
        ]);
    }

    public function channel($id, $pageToken = null)
    {
        $parameters = [];
        $parameters['part']         = 'snippet';
        $parameters['maxResults']   = 48;
        $parameters['channelId']    = $id;
        $parameters['type']         = 'video';
        $parameters['order']        = 'date';
        $parameters['safeSearch']   = 'none';
        if ($pageToken) $parameters['pageToken'] = $pageToken;

        $result = YoutubeApi::request('search', $parameters);

    	return view('youtube.channel', [
            'id' => $id,
            'result' => $result,
        ]);
    }
}
