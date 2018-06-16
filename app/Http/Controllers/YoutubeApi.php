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

        /*
    	// retrieve data as json
        $json = file_get_contents($url.'?'.http_build_query($parameters));
        */

        // retrieve data as json with curl
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url.'?'.http_build_query($parameters) );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $json = curl_exec( $ch );
        
        curl_close($ch);

        // convert json to object
        $obj = json_decode($json);

        return $obj;
    }
}
