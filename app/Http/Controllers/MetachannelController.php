<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Metachannel;
use App\Channel;
use DB;
use App\Http\Controllers\UpdateController;

class MetachannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metachannels = Metachannel::all();

        return view('metachannel.index', ['metachannels' => $metachannels]);
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

        $metachannelId = DB::table('metachannels')->insertGetId([
            'name'          => $request->name,
            'description'   => $request->description,
        ]);


        foreach ($request->channels as $channel)
        {
            if($channel != '')
            {
                $this->add_channel($metachannelId, $channel);
            }
        }

        \App::make('App\Http\Controllers\UpdateController')->metachannel($metachannelId);

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
        $metachannel->delete();

        $this->remove_all_channels($id);

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
}
