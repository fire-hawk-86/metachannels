@extends('layout')

@section('navbar')
  
  <li><a href="{{ url('meta/new') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New</a></li>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>All Metachannels</h2>
          <hr>
        </div>

        @foreach($metachannels as $metachannel)
          <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a href="{{ url("meta/$metachannel->id") }}">
              @if($metachannel->videos()->isNotEmpty())
                <img src="https://img.youtube.com/vi/{{ $metachannel->videos()->first()->ytid }}/mqdefault.jpg" alt="">
              @else
                <img src="http://via.placeholder.com/320x180" alt="">
              @endif
              <h3>{{ $metachannel->name }}</h3>
            </a>
            <p>
              Channels:

              @foreach($metachannel->channels as $channel)
                <a href="https://www.youtube.com/channel/{{ $channel->ytid }}">{{ $channel->name }}</a>{{ $loop->remaining ? ', ' : '' }}
              @endforeach

            </p>
          </div>
        @endforeach

      </div>
    </div>
@endsection
