@extends('layouts.app')

@section('title', 'Channel: '.$result->items[0]->snippet->channelTitle.' - ')

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
        <!-- Header -->
        <div class="row">
            <div class="col-md-12">
                <h1>Channel: {{ $result->items[0]->snippet->channelTitle }}</h1>
            </div>
        </div>
        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="...">
                    <ul class="pager">
                        @isset($result->prevPageToken)
                            <li class="previous"><a href="{{ url("channel/$id/$result->prevPageToken") }}"><span aria-hidden="true">&larr;</span> Newer</a></li>
                        @endisset
                        @isset($result->nextPageToken)
                            <li class="next"><a href="{{ url("channel/$id/$result->nextPageToken") }}">Older <span aria-hidden="true">&rarr;</span></a></li>
                        @endisset
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Content -->
        <div class="row">
            @if(count($result->items) > 0)
                @foreach($result->items as $video)
                    <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2">
                        <a href="{{ url('video/'.$video->snippet->resourceId->videoId) }}">
                            <img src="https://img.youtube.com/vi/{{ $video->snippet->resourceId->videoId }}/mqdefault.jpg" alt="">
                            <h4 class="header-margin-fix">{{ $video->snippet->title }}</h4>
                        </a>
                        <p>{{ Carbon\Carbon::parse($video->snippet->publishedAt)->format('d. F Y') }} (<a href="{{ url('channel/'.$video->snippet->channelId) }}" target="_blank">{{ $video->snippet->channelTitle }}</a>)</p>
                        <p style="font-size: 14px;">{{ $video->snippet->description }}</p>
                        <hr class="visible-xs-block">
                    </div>
                @endforeach
            @else
                <p>No videos found.</p>
            @endif
        </div>
        <!-- Pagination -->
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="...">
                    <ul class="pager">
                        @isset($result->prevPageToken)
                        <li class="previous"><a href="{{ url("channel/$id/$result->prevPageToken") }}"><span aria-hidden="true">&larr;</span> Newer</a></li>
                        @endisset
                        @isset($result->nextPageToken)
                        <li class="next"><a href="{{ url("channel/$id/$result->nextPageToken") }}">Older <span aria-hidden="true">&rarr;</span></a></li>
                        @endisset
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
