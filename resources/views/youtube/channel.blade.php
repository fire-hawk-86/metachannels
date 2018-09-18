@extends('layouts.app')

@section('title', 'Channel: '.$result->items[0]->snippet->channelTitle.' - ')

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-md-12">
                <h1>Channel: <a href="{{ url("https://www.youtube.com/channel/$channel->id") }}"><img src="{{ $channel->snippet->thumbnails->default->url }}" class="img-circle" style="width: 48px; height: 48px; vertical-align: -25%;"> {{ $result->items[0]->snippet->channelTitle }}</a></h1>
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
                    <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2" style="overflow-x: hidden;">
                        <a href="{{ url('video/'.$video->snippet->resourceId->videoId.'?channel='.$channel->id) }}">
                            <img src="https://img.youtube.com/vi/{{ $video->snippet->resourceId->videoId }}/mqdefault.jpg" alt="">
                            <h4 class="header-margin-fix">{{ $video->snippet->title }}</h4>
                        </a>
                        <p>{{ Carbon\Carbon::parse($video->snippet->publishedAt)->format('d. F Y') }}</p>
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
