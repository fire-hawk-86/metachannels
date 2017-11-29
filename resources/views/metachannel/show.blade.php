@extends('layout')

@section('content')
    <div class="container">
      <h2>Metachannel: {{ $metachannel->name }}</h2>
      <p>Channels:

        @foreach($metachannel->channels as $channel)
          <a href="https://www.youtube.com/channel/{{ $channel->ytid }}">{{ $channel->name }}</a>,
        @endforeach

      </p>

      @foreach($videos as $video)
        <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2">
          <a href="https://www.youtube.com/watch?v={{ $video->ytid }}">
            <img src="https://img.youtube.com/vi/{{ $video->ytid }}/default.jpg" alt="">
            <h3>{{ $video->name }}</h3>
          </a>
          <p>uploaded: {{ $video->uploaded_at }}</p>
          <p>{{ $video->description }}</p>
        </div>
      @endforeach

    </div>
@endsection
