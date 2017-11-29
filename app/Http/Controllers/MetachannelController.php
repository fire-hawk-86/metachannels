<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Metachannel;
use DB;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get metachannel
        $metachannel = Metachannel::find($id);

        // extract all channel IDs from metachannel
        $channelIds = [];
        foreach($metachannel->channels as $channel)
        {
            $channelIds[] = $channel->id;
        }

        // get all videos based on the channel IDs
        $videos = DB::table('videos')
                    ->whereIn('channel_id', $channelIds)
                    ->orderBy('uploaded_at', 'desc')
                    ->get();

        return view('metachannel.show', [
            'metachannel'   => $metachannel,
            'videos'        => $videos
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
