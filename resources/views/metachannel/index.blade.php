@extends('layout')

@section('content')
    <div class="container">
      <h2>All</h2>
      <!-- div.col-sm-6.col-md-4.col-lg-3.col-xl-2*8>img[src=http://via.placeholder.com/300x200]+h3{Metachannel $}+p{just a test} -->
      
      @foreach($metachannels as $metachannel)
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
          <a href="{{ url('metachannels').'/'.$metachannel->id}}">
            <img src="http://via.placeholder.com/300x200" alt="">
            <h3>{{ $metachannel->name }}</h3>
          </a>
          <p>
            Channels:
            @foreach($metachannel->channels as $channel)
              <a href="https://www.youtube.com/channel/{{ $channel->ytid }}">{{ $channel->name }}</a>,
            @endforeach
          </p>
        </div>
      @endforeach
      
      <!--
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 1</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 2</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 3</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 4</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 5</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 6</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 7</h3>
        <p>just a test</p>
      </div>
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <img src="http://via.placeholder.com/300x200" alt="">
        <h3>Metachannel 8</h3>
        <p>just a test</p>
      </div>
      -->
    </div>
@endsection
