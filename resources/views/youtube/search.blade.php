@extends('layout')

@section('title', 'Search - ')

@section('navbar')
    <li>
        <form method="POST" class="form-inline" style="margin-top: 8px" action="{{url('search')}}">
            <input name="query" class="form-control" type="text" placeholder="Search" value="{{ $query }}">
            <input class="form-control btn btn-default" type="submit" value="Send">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </li>
@endsection

@section('content')
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <h2>Suche: {{ $query }}</h2>
          </div>
        @foreach ($result->items as $video)
            <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ url('video').'/'.$video->id->videoId }}">
                    <img src="https://img.youtube.com/vi/{{ $video->id->videoId }}/mqdefault.jpg" alt="">
                    <h3>{{ $video->snippet->title }}</h3>
                </a>
                <p>{{ $video->snippet->publishedAt }} (<a href="channel/{{ $video->snippet->channelId }}" target="_blank">{{ $video->snippet->channelTitle }}</a>)</p>
                <p>{{ $video->snippet->description }}</p>
            </div>
        @endforeach
      </div>
    </div>
@endsection
