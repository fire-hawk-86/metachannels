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

        DB::table('metachannels')->insert([
            'name'          => $request->name,
            'description'   => $request->description,
        ]);

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

        return redirect('/');
    }
}
