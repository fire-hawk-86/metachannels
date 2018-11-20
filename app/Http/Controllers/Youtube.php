<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Metachannel;

class Youtube extends Controller
{
    public function video(Request $request, $id)
    {
        if ($channelId = $request->get('channel'))
        {
            $channel = YoutubeApi::request('channels', [
        		'part'              => 'snippet, contentDetails',
                'id'                => $channelId,
        	])->items[0];

            $playlistId = $channel->contentDetails->relatedPlaylists->uploads;

            $playlistItems = YoutubeApi::request('playlistItems', [
        		'part'       => 'snippet, contentDetails',
                'maxResults' => '50',
                'playlistId' => $playlistId,
        	]);

            $channel->playlistItems = $playlistItems;
        }


        if ($metachannelId = $request->get('metachannel'))
        {
            $metachannel = Metachannel::find($metachannelId);
        }
        else
        {
            $metachannel = null;
        }

        $vid = YoutubeApi::request('videos', [
            'id'    => $id,
            'part'  => 'snippet',
        ]);

        // make links clickable in description
        $description = $vid->items[0]->snippet->description;
        $description = preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;//=]+)!i', '<a href="$1">$1</a>', $description);
        $vid->items[0]->snippet->description = $description;

        $data = [];
        $data['id'] = $id;
        $data['vid'] = $vid->items[0];
        if (isset($channel))
        {
            $data['channel'] = $channel;
        }
        if (isset($metachannel))
        {
            $data['metachannel'] = $metachannel;
        }

        return view('youtube.video', $data);
    }

    public function channel($id, $pageToken = null)
    {
        $parameters = [
            'id'   => $id,
            'part' => 'contentDetails,snippet',
        ];
        $channel = YoutubeApi::request('channels', $parameters)->items[0];

        $parameters = [
            'playlistId' => $channel->contentDetails->relatedPlaylists->uploads,
            'maxResults' => 25,
            'part'       => 'snippet',
        ];
        if ($pageToken) $parameters['pageToken'] = $pageToken;
        $result = YoutubeApi::request('playlistItems', $parameters);

    	return view('youtube.channel', [
            'id' => $id,
            'channel' => $channel,
            'result' => $result,
        ]);
    }
}
