<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use SimpleXMLElement;
use Carbon\Carbon;
use App\Metachannel;
use App\Channel;
use App\User;
use Auth;
use DB;

class MetachannelController extends Controller
{
    /**
     * Authentication required for editing and removing Metachannels.
     *
     * @return void
     */
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
        return view('metachannel.create');
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
            'channels.*'    => 'nullable|url',
        ]);

        $metachannel = new Metachannel;
        if (Auth::check())
            $metachannel->user_id = Auth::id();
        $metachannel->name          = $request->name;
        $metachannel->description   = $request->description;
        $metachannel->last_refresh  = Carbon::now()->toDateTimeString();
        $metachannel->save();

        try
        {
            foreach ($request->channels as $channel)
            {
                if($channel != '')
                {
                    $this->add_channel($metachannel->id, $channel);
                }
            }

            $this->update_channels($metachannel->id);
        }
        catch (\Exception $e)
        {
            if(env('APP_ENV') == 'local')
                session()->flash('message', 'Error(MetachannelController@store): '.$e->getMessage());
            elseif (env('APP_ENV') == 'production')
                session()->flash('message', 'Error');
            $metachannel->delete();
        }


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

        // last time refreshed the videos of the list of channels
        $last_refresh = Carbon::parse($metachannel->last_refresh);
        $now = Carbon::now();
        // have an amount of minutes past ?
        $minutes = $last_refresh->diffInMinutes($now);

        if($minutes >= env('REFRESH_MINUTES', 60))
        {
            // update last_refresh column
            $metachannel->last_refresh = Carbon::now()->toDateTimeString();
            $metachannel->save();

            // then update the channels
            $this->update_channels($id);
            $last_refresh = $now;
        }

        return view('metachannel.show', [
            'metachannel' => $metachannel,
            'minutes' => $last_refresh->diffForHumans($now),
        ]);
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
        return view('metachannel.edit', ['metachannel' => $metachannel]);
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

    /**
     * Add a channel to the specified metachannel.
     *
     * @param  int  $metachannelId
     * @param  str  $url
     * @return void
     */
    public function add_channel($metachannelId, $url)
    {
        $url_parts = explode('/', $url);

        if($url_parts[3] == 'channel')
        {
            $channelYtid = $url_parts[4];
            echo 'channel ID is '.$channelYtid;
            $channel_data = YoutubeApi::request('channels', [
                'part' => 'snippet,id',
                'id'   => $channelYtid,
            ]);
        }
        elseif ($url_parts[3] == 'user') {
            $channelName = $url_parts[4];
            echo 'channel name is '.$channelName;
            $channel_data = YoutubeApi::request('channels', [
                'part'        => 'snippet',
                'forUsername' => $channelName,
            ]);
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

    /**
     * Remove all associations between the specified metachannel and it's channels.
     *
     * @param  int  $metachannelId
     * @return void
     */
    public function remove_all_channels($metachannelId)
    {
        DB::table('channel_metachannel')->where('metachannel_id', $metachannelId)->delete();
    }

    /**
     * Update all channels associated with the specified metachannel.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_channels($id)
    {
        $metachannel = Metachannel::find($id);

        try
        {
            foreach ($metachannel->channels as $channel)
            {
                $obj = YoutubeApi::request('search', [
                    'channelId' => $channel->ytid,
                    'part'  => 'snippet,id',
                    'order' => 'date',
                    'maxResults' => 10,
                    'publishedAfter' => '2017-11-01T00:00:00Z',
                ]);

                $videos = $obj->items;

                foreach ($videos as $video)
                {
                    if($video->id->kind == 'youtube#video')
                    {
                        if( count( DB::table('videos')->where('ytid', $video->id->videoId)->get()->all() ) == 0)
                        {
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
        }
        catch (\Exception $e)
        {
            if(env('APP_ENV') == 'local')
                session()->flash('message', 'Error(MetachannelController@update_channels): '.$e->getMessage());
            elseif (env('APP_ENV') == 'production')
                session()->flash('message', 'Error');
            return redirect('/meta/'.$id);
        }

        return redirect('/meta/'.$id);
    }

    /**
     * Show all metachannels of the specified user.
     *
     * @param  int  $user
     * @return \Illuminate\Http\Response
     */
    public function index_user($user)
    {
        $user = User::where('name', $user)->firstOrFail();
        $metachannels = Metachannel::where('user_id', $user->id)->get();

        // if someone is logged in
        if(Auth::check())
        {
            // if you are the user of this metachannel list
            if (Auth::user()->name == $user->name) {
                $title = "My Metachannels";
            }
        }
        else
        {
            $title = "Metachannels of $user->name";
        }

        return view('metachannel.index', [
            'title' => $title,
            'metachannels' => $metachannels,
        ]);
    }

    /**
     * Export all metachannels associated with the user to xml.
     *
     * @param  str  $user
     * @return void
     */
    public function export_xml($user)
    {
        $user = User::where('name', $user)->first();
        $metachannels = Metachannel::where('user_id', $user->id)->get();

        $xml_metachannels = new SimpleXMLElement('<metachannels/>');

        foreach ($metachannels as $metachannel) {
            $xml_metachannel = $xml_metachannels->addChild('metachannel');
            $xml_metachannel->addChild('name', $metachannel->name);
            $xml_metachannel->addChild('description', $metachannel->description);
            $xml_channels = $xml_metachannel->addChild('channels');
            foreach ($metachannel->channels as $channel) {
                $xml_channel = $xml_channels->addChild('channel');
                $xml_channel->addChild('name', $channel->name);
                $xml_channel->addChild('id', $channel->ytid);
            }
        }

        $response = Response::make($xml_metachannels->asXML());

        return $response
            ->header('Content-Type', 'text/xml')
            ->header('Content-Disposition', 'attachment; filename="metachannels.xml"')
        ;
    }
}
