<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\YoutubeApi;

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

        return view('video', [
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

        return view('search', [
            'result' => $obj,
            'query' => $query
        ]);
    }

    public function channel($id)
    {
    	//
    }
}
