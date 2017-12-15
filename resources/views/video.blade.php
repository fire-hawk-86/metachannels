@extends('layout')

@section('title', $vid->snippet->title . ' - ')

@section('navbar')
    <li>
        <form method="POST" class="form-inline" style="margin-top: 8px" action="{{url('search')}}">
            <input name="query" class="form-control" type="text" placeholder="Search">
            <input class="form-control btn btn-default" type="submit" value="Send">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </li>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <div class="video-container">
                <iframe width="853" height="480" src="https://www.youtube.com/embed/{{ $id }}?rel=0&autoplay=1" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            </div>
            <h2>{{$vid->snippet->title}}</h2>
            <p>Channel: <a href="{{ url('https://www.youtube.com/channel/'.$vid->snippet->channelId) }}">{{ $vid->snippet->channelTitle }}</a></p>
            <p style="white-space: pre-line; font-size: 13px;">{!! $vid->snippet->description !!}</p>
            <p class="text-center"><a href="#">weniger anzeigen</a></p>
        </div>
        <div class="col-md-4">
            <h2 class="first-item" title="youtube.com doesn't give you this option anymore">Related Videos<br><small>(instead of recomended)</small></h2>
            @foreach ($related_videos->items as $video)
                <div class="clear-fix" style="display: block; min-height: 100px">
                    <a href="{{ url('video/'.$video->id->videoId) }}">
                        <img class="pull-left" src="{{$video->snippet->thumbnails->default->url}}">
                        <p style="margin-left: 130px;">{{$video->snippet->title}}</p>
                    </a>
                    <p style="margin-left: 130px;">{{$video->snippet->publishedAt}}</p>
                    <p style="margin-left: 130px">Channel: <a href="{{ url('https://www.youtube.com/channel/'.$video->snippet->channelId) }}">{{ $video->snippet->channelTitle }}</a></p>
                </div>
            @endforeach
        </div>
      </div>
    </div>
@endsection
