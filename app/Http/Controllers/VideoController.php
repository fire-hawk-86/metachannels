<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __invoke($id)
    {
        $url = 'https://www.googleapis.com/youtube/v3/search';
        $parameters = [
            'part'              => 'snippet',
            'maxResults'        => 25,
            'relatedToVideoId'  => $id,
            'type'              => 'video',
            'key'               => env('GOOGLE_API_KEY')
        ];
        $json = file_get_contents($url.'?'.http_build_query($parameters));
        $related_videos = json_decode($json);

        https://www.googleapis.com/youtube/v3/videos?id={videoId}&key={myApiKey}&part=snippet

        $url = 'https://www.googleapis.com/youtube/v3/videos';
        $parameters = [
            'id'                => $id,
            'part'              => 'snippet',
            'key'               => env('GOOGLE_API_KEY')
        ];
        $json = file_get_contents($url.'?'.http_build_query($parameters));
        $vid = json_decode($json);

        // make links clickable in description
        $description = $vid->items[0]->snippet->description;
        $description = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $description);
        $vid->items[0]->snippet->description = $description;

        return view('video', ['id' => $id,
                              'related_videos' => $related_videos,
                              'vid'            => $vid->items[0] ]);
    }
}
