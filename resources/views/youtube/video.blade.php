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
                <h3>{{$vid->snippet->title}}</h3>
                <p style="float: left;">Channel: <a href="{{ url('channel/'.$vid->snippet->channelId) }}">{{ $vid->snippet->channelTitle }}</a></p>
                <p style="float: right;">{{ Carbon\Carbon::parse($vid->snippet->publishedAt)->format('d. F Y') }}</p>
                <p style="clear:both; white-space: pre-line; font-size: 13px; margin-bottom: 20px;">{!! $vid->snippet->description !!}</p>
            </div>
            <!-- Sidebar -->
            <div class="col-md-4 sidebar">
                @isset($related_videos)
                    <h3 class="first-item" title="youtube.com doesn't give you this option anymore">Related Videos<br><small>(instead of recomended)</small></h3>
                    @foreach ($related_videos->items as $video)

                        <div class="{{ $id == $video->contentDetails->videoId ? 'active' : '' }}" style="display: flex; align-items: flex-start; padding: 5px;" data-video="{{ $video->contentDetails->videoId }}">
                            <a href="{{ url('video/'.$video->contentDetails->videoId.'?channel='.$channel->id) }}">
                                <img style="flex: 0 0 150px; width: 150px; height:auto; margin-right:10px;" src="https://img.youtube.com/vi/{{ $video->contentDetails->videoId }}/mqdefault.jpg">
                            </a>
                            <div style="margin-bottom: 0;">
                                <p><a href="{{ url('video/'.$video->contentDetails->videoId.'?channel='.$channel->id) }}" style="text-decoration: none;">{{ $video->snippet->title }}</a></p>
                                <p><a href="{{ url("channel/".$video->snippet->channelId) }}" style="color: inherit; text-decoration: none;">{{ $video->snippet->channelTitle }}</a></p>
                            </div>
                        </div>

                    @endforeach
                @endisset
                @isset($channel)
                    <h3><a href="{{ url("channel/$channel->id") }}">{{ $channel->snippet->title }}:</a></h3>
                    @foreach ($channel->playlistItems->items as $video)

                        <div class="{{ $id == $video->contentDetails->videoId ? 'active' : '' }}" style="display: flex; align-items: flex-start; padding: 5px;" data-video="{{ $video->contentDetails->videoId }}">
                            <a href="{{ url('video/'.$video->contentDetails->videoId.'?channel='.$channel->id) }}">
                                <img style="flex: 0 0 150px; width: 150px; height:auto; margin-right:10px;" src="https://img.youtube.com/vi/{{ $video->contentDetails->videoId }}/mqdefault.jpg">
                            </a>
                            <div style="margin-bottom: 0;">
                                <p><a href="{{ url('video/'.$video->contentDetails->videoId.'?channel='.$channel->id) }}" style="text-decoration: none;">{{ $video->snippet->title }}</a></p>
                            </div>
                        </div>

                    @endforeach
                @endisset
                @isset($metachannel)
                    <h3><a href="{{ url("meta/$metachannel->id") }}">{{ $metachannel->name }}:</a></h3>
                    @foreach ($metachannel->videos() as $video)

                        <div class="{{ $id == $video->ytid ? 'active' : '' }}" style="display: flex; align-items: flex-start; padding: 5px;" data-video="{{ $video->ytid }}">
                            <a href="{{ url("video/$video->ytid?metachannel=$metachannel->id") }}">
                                <img style="flex: 0 0 150px; width: 150px; height:auto; margin-right:10px;" src="https://img.youtube.com/vi/{{ $video->ytid }}/mqdefault.jpg">
                            </a>
                            <div style="margin-bottom: 0;">
                                <p><a href="{{ url("video/$video->ytid?metachannel=$metachannel->id") }}" style="text-decoration: none;">{{ $video->name }}</a></p>
                                <p><a href="{{ url("channel/".$video->channel->ytid) }}" style="color: inherit; text-decoration: none;">{{ $video->channel->name }}</a></p>
                            </div>
                        </div>
                        
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
            if (document.fullscreenElement == null) {

                // not in fullscreen
                var next_link = $('.sidebar .active').prev().find("a").attr('href');
                window.open(next_link,"_self");
            }
            else {
                // in fullscreen
                var next_link = $('.sidebar .active').prev().find("a").attr('href');
                next_id = next_link.substring( 0, next_link.indexOf('?') ).split('/')[4];

                $('.sidebar .active').removeClass('active').prev().addClass('active');

                player.loadVideoById(next_id);
            }
        }
    </script>
@endsection
