<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

class YoutubeApi extends Controller
{
    static public function request($type, $parameters)
    {
    	// add type to url
    	$url = "https://www.googleapis.com/youtube/v3/$type";

    	// add api key to parameters
    	$parameters['key'] = env('GOOGLE_API_KEY');

    	// retrieve data as json
        $json = file_get_contents($url.'?'.http_build_query($parameters));

        // convert json to object
        $obj = json_decode($json);

        return $obj;
    }

    static public function search_youtube_channel($query)
    {
        $obj = YoutubeApi::request('search', [
            'part'       => 'snippet',
            'maxResults' => 5,
            'q'          => $query,
            'type'       => 'channel',
        ]);

        return response()->json($obj);
    }

    static public function combineResponses($responses)
    {

    }
}
