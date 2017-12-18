<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Metachannel;
use App\Channel;
use DB;
use App\User;
use Auth;

class MetachannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['only' => [
            'edit', 'update', 'destroy',
        ]]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metachannels = Metachannel::all();

        return view('metachannel.index', [
            'title' => 'All Metachannels',
            'metachannels' => $metachannels,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('metachannel/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|unique:metachannels',
            'description'   => 'required',
        ]);

        $metachannel = new Metachannel;
        if (Auth::check())
        {
            $metachannel->user_id   = Auth::id();
        }
        $metachannel->name          = $request->name;
        $metachannel->description   = $request->description;
        $metachannel->save();

        foreach ($request->channels as $channel)
        {
            if($channel != '')
            {
                $this->add_channel($metachannel->id, $channel);
            }
        }

        $this->update_channels($metachannel->id);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $metachannel = Metachannel::find($id);

        return view('metachannel.show', ['metachannel' => $metachannel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $metachannel = Metachannel::find($id);
        return view('metachannel/edit', ['metachannel' => $metachannel]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metachannel = Metachannel::find($id);

        if ($metachannel->user_id == Auth::id() or $metachannel->user_id == null)
        {
            $this->validate($request, [
                'name'          => 'required',
                'description'   => 'required',
            ]);

            DB::table('metachannels')->where('id', $id)
                ->update([
                    'name'          => $request->name,
                    'description'   => $request->description,
                ]);

            $this->remove_all_channels($id);

            foreach ($request->channels as $channel)
            {
                if($channel != '')
                {
                    $this->add_channel($id, $channel);
                }
            }

            $this->update_channels($id);
        }
        else
        {
            return "Can't edit this Metachannel. Wrong user.";
        }

        return redirect('/meta/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $metachannel = Metachannel::find($id);
        
        if ($metachannel->user_id == Auth::id() or $metachannel->user_id == null)
        {
            $metachannel->delete();
            $this->remove_all_channels($id);
        }
        else
        {
            return "This is not your metachannel, can't delete it";
        }

        return redirect('/');
    }

    public function add_channel($metachannelId, $url)
    {
        $url_parts = explode('/', $url);

        if($url_parts[3] == 'channel')
        {
            $channelYtid = $url_parts[4];
            echo 'channel ID is '.$channelYtid;
            $channel_data = json_decode( file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet&id='.$channelYtid.'&key='.env('GOOGLE_API_KEY')) );
        }
        elseif ($url_parts[3] == 'user') {
            $channelName = $url_parts[4];
            echo 'channel name is '.$channelName;
            $channel_data = json_decode( file_get_contents('https://www.googleapis.com/youtube/v3/channels?part=snippet&forUsername='.$channelName.'&key='.env('GOOGLE_API_KEY')) );
        }

        if(count(Channel::where('ytid', $channel_data->items[0]->id)->get()->all()) == 0)
        {
            $channelId = Channel::insertGetId([
                'ytid'          => $channel_data->items[0]->id,
                'name'          => $channel_data->items[0]->snippet->title,
                'description'   => $channel_data->items[0]->snippet->description
            ]);
        }
        else
        {
            $channelId = Channel::where('ytid', $channel_data->items[0]->id)->get()->first()->id;
        }

        $count = count( DB::table('channel_metachannel')->where([
                            ['channel_id', $channelId],
                            ['metachannel_id', $metachannelId]
                        ])->get()->all() );

        if($count == 0)
        {
            DB::table('channel_metachannel')->insert([
                'channel_id'     => $channelId,
                'metachannel_id' => $metachannelId
            ]);
        }
    }

    public function remove_all_channels($metachannelId)
    {
        DB::table('channel_metachannel')->where('metachannel_id', $metachannelId)->delete();
    }

    public function update_channels($id)
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

    public function index_user($user)
    {
        $user = User::where('name', $user)->firstOrFail();
        $metachannels = Metachannel::where('user_id', $user->id)->get();

        return view('metachannel.index', [
            'title' => 'Metachannels of ' . $user->name,
            'metachannels' => $metachannels,
        ]);
    }
}
