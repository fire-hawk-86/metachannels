<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class VideoSearchController extends Controller
{
    public function __invoke($query)
    {
        $url = 'https://www.googleapis.com/youtube/v3/search';
        $parameters = [
            'part'              => 'snippet',
            'maxResults'        => 16,
            'q'                 => $query,
            'type'              => 'video',
            'key'               => env('GOOGLE_API_KEY')
        ];
        $json = file_get_contents($url.'?'.http_build_query($parameters));
        $obj = json_decode($json);

        return view('search', ['result' => $obj, 'query' => $query]);
    }

    public function processForm()
    {
        $query = Input::get('query');
        return redirect('search/'.$query);
    }
}
