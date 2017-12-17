<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChannelController extends Controller
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
        $videos = json_decode($json);

        return view('channel');
    }
}
