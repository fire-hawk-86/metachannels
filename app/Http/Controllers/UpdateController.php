<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Metachannel;
use App\Channel;
use App\Video;
use DB;

class UpdateController extends Controller
{
    public function metachannel($id)
    {
    	$metachannel = Metachannel::find($id);
    	echo 'Updating Metachannel "'.$metachannel->name.'" (id='.$metachannel->id.') ...<br><br>';
        foreach ($metachannel->channels as $channel)
        {
            $url = 'https://www.googleapis.com/youtube/v3/search?key='.env('GOOGLE_API_KEY').'&channelId='.$channel->ytid.'&part=snippet,id&order=date&maxResults=20';
            $json = file_get_contents($url);
            $obj = json_decode($json);

            $videos = $obj->items;

            foreach ($videos as $video)
            {
                if($video->id->kind == 'youtube#video')
                {
                    if( count( DB::table('videos')->where('ytid', $video->id->videoId)->get()->all() ) == 0)
                    {
                        /*
                        echo $video->id->videoId.'<br>';
                        echo $video->snippet->title.'<br>';
                        echo $video->snippet->description.'<br>';
                        echo date("Y-m-d G:i:s", strtotime($video->snippet->publishedAt)).'<br>';
                        echo '<br>';
                        */
                        
                        DB::table('videos')->insert([
                            'ytid'          => $video->id->videoId,
                            'channel_id'    => $channel->id,
                            'name'          => $video->snippet->title,
                            'description'   => $video->snippet->description,
                            'uploaded_at'   => date("Y-m-d G:i:s", strtotime($video->snippet->publishedAt))
                        ]);
                        
                    }
                }
            }
        }
        return redirect('/meta/'.$id);
    }

    public function channel($id)
    {
    	echo "Updating Channel $id<br>";
    	$channel = Channel::find($id);
        $url = 'https://www.googleapis.com/youtube/v3/search?key='.env('GOOGLE_API_KEY').'&channelId='.$channel->ytid.'&part=snippet,id&order=date&maxResults=20';
        $json = file_get_contents($url);
        dd($json);
    }
}
