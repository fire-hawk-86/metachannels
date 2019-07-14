@extends('layouts.app')

@section('title', $vid->snippet->title . ' - ')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Main -->
            <div class="col-md-8" id="main">
                <div class="embed-responsive embed-responsive-16by9">
                    <div id="ytplayer"></div>
                </div>
                <noscript>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe id="ytplayer" width="853" height="480" src="https://www.youtube.com/embed/{{ $id }}?rel=0&autoplay=0" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                    </div>
                </noscript>
                <a id="view-button" class="btn btn-default btn-sm pull-right" style="margin-top: 11px;" href="#">Change View</a>
                <h3>{{$vid->snippet->title}}</h3>
                <p style="float: left;">Channel: <a href="{{ url('channel/'.$vid->snippet->channelId) }}">{{ $vid->snippet->channelTitle }}</a></p>
                <p style="float: right;">{{ Carbon\Carbon::parse($vid->snippet->publishedAt)->format('d. F Y') }}</p>
                <p style="clear:both; white-space: pre-line; font-size: 13px; margin-bottom: 20px;">{!! $vid->snippet->description !!}</p>
                @if (config('disqus.enabled'))
                    <div id="disqus_thread" class="text-center" style="margin-top: 22px;">
                        <a class="btn btn-primary" style="display: inline-block; background: none; margin-top: 2.5rem;" href="#" onclick="disqus();return false;">Show Comments</a>
                    </div>
                @endif
            </div>
            <!-- Sidebar -->
            <div class="col-md-4 sidebar">
                @isset($related_videos)
                    <h3 class="first-item" title="youtube.com doesn't give you this option anymore">Related Videos<br><small>(instead of recomended)</small></h3>
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
                @endisset
                @isset($channel)
                    <h3><a href="{{ url("channel/$channel->id") }}">{{ $channel->snippet->title }}:</a></h3>
                    @foreach ($channel->playlistItems->items as $video)
                        <a class="{{ $id == $video->contentDetails->videoId ? 'active' : '' }}" style="display: flex; align-items: flex-start; padding: 5px;" data-video="{{ $video->contentDetails->videoId }}" href="{{ url('video/'.$video->contentDetails->videoId.'?channel='.$channel->id) }}">
                            <img style="flex: 0 0 150px; width: 150px; height:auto; margin-right:10px;" src="https://img.youtube.com/vi/{{ $video->contentDetails->videoId }}/mqdefault.jpg">
                            <p style="margin-bottom: 0;">{{ $video->snippet->title }}</p>
                        </a>
                    @endforeach
                @endisset
                @isset($metachannel)
                    <h3><a href="{{ url("meta/$metachannel->id") }}">{{ $metachannel->name }}:</a></h3>
                    @foreach ($metachannel->videos() as $video)
                        <a class="{{ $id == $video->ytid ? 'active' : '' }}" style="display: flex; align-items: flex-start; padding: 5px;" data-video="{{ $video->ytid }}" href="{{ url("video/$video->ytid?metachannel=$metachannel->id") }}">
                            <img style="flex: 0 0 150px; width: 150px; height:auto; margin-right:10px;" src="https://img.youtube.com/vi/{{ $video->ytid }}/mqdefault.jpg">
                            <p style="margin-bottom: 0;">{{ $video->name }}</p>
                        </a>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
          var player;

          function onYouTubeIframeAPIReady() {
            player = new YT.Player('ytplayer', {
              height: '300',
              width: '400',
              videoId: '{{ $id }}',
              playerVars: { 'autoplay': 1, 'controls': 1,'autohide':1,'wmode':'opaque', 'rel':0 },
              events: {
                'onStateChange': function(event) {
                  if (event.data == YT.PlayerState.ENDED) {
                      myFunction();
                  }
                }
              }
            });
          }
    </script>

    <script>
        function myFunction() {
            var next_link = $('.sidebar .active').prev().attr('href');
            window.open(next_link,"_self");
        }
    </script>
@endsection
