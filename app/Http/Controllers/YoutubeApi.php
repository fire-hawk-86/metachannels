<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class YoutubeApi extends Controller
{
    static public function request($type, $parameters)
    {
    	// add type to url
    	$url = "https://www.googleapis.com/youtube/v3/$type";

    	// add api key to parameters
    	$parameters['key'] = env('GOOGLE_API_KEY');

    	// retrieve data as json
        try
        {
            $json = file_get_contents($url.'?'.http_build_query($parameters));

            // convert json to object
            $obj = json_decode($json);

            return $obj;
        }
        catch (Exception $e)
        {
            // flash error message to session
            session()->flash('message', 'Caught exception: '.$e->getMessage());
            // return empty json instead
            return json_decode('{}');
        }
    	
    }

    static public function combineResponses($responses)
    {

    }
}
