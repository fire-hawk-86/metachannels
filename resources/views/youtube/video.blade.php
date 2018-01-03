@extends('layouts.app')

@section('title', $vid->snippet->title . ' - ')

@section('navbar')
    <li>
        <form method="POST" class="form-inline" style="margin-top: 8px" action="{{url('search')}}">
            <input name="query" class="form-control" type="text" placeholder="Search">
            <input class="form-control btn btn-default" type="submit" value="Send">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </li>
    @parent
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <!-- Main -->
        <div class="col-md-8" id="main">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe width="853" height="480" src="https://www.youtube.com/embed/{{ $id }}?rel=0&autoplay=1" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
            </div>
            <a id="view-button" class="btn btn-default btn-sm pull-right" style="margin-top: 11px;" href="#">Change View</a>
            <h3>{{$vid->snippet->title}}</h3>
            <p style="float: left;">Channel: <a href="{{ url('channel/'.$vid->snippet->channelId) }}">{{ $vid->snippet->channelTitle }}</a></p>
            <p style="float: right;">{{ Carbon\Carbon::parse($vid->snippet->publishedAt)->format('d. F Y') }}</p>
            <p style="clear:both; white-space: pre-line; font-size: 13px; margin-bottom: 20px;">{!! $vid->snippet->description !!}</p>
        </div>
        <!-- Sidebar -->
        <div class="col-md-4">
            <h3 class="first-item" title="youtube.com doesn't give you this option anymore">Related Videos<br><small>(instead of recomended)</small></h3>
            <!--
            <div class="form-group">
                <select class="form-control">
                    <option value="">All Channels</option>
                    <option value="">This Channel</option>
                    <option value="">Other Channels</option>
                </select>
            </div>
            -->
            @foreach ($related_videos->items as $video)
            <div style="min-height: 78px; font-size: .8em; position: relative;">
                <a href="{{ url('video/'.$video->id->videoId) }}">
                    <img style="position: absolute; top: -11px; left: 0; clip: rect(11px,120px,79px,0px);" src="{{$video->snippet->thumbnails->default->url}}">
                    <div style="margin-left: 130px; line-height: 1.6; max-height: 3.2em; overflow: hidden;" title="{{ $video->snippet->title }}">{{$video->snippet->title}}</div>
                </a>
                <div style="margin-left: 130px;">{{Carbon\Carbon::parse($video->snippet->publishedAt)->format('d. F Y')}}</div>
                <div style="margin-left: 130px; margin-bottom: 10px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Channel: <a href="{{ url('channel/'.$video->snippet->channelId) }}">{{ $video->snippet->channelTitle }}</a></div>
            </div>
            @endforeach
        </div>
      </div>
    </div>
@endsection
