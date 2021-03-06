@extends('layouts.app')

@section('title', $metachannel->name . ' - ')

@section('navbar')
    <li><a href="{{ url("meta/$metachannel->id/edit") }}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> {{__('Edit')}}</a></li>
    <li><a title="{{ $minutes }}"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> {{__('Update')}}</a></li>
    <li><a onclick="document.getElementById('delete-form').submit();" href="#"><span class="glyphicon glyphicon-remove text-danger" aria-hidden="true"></span> <span class="text-danger">{{__('Delete')}}</span></a></li>
    <li>
        <form id="delete-form" method="POST" action="{{ url("meta/$metachannel->id") }}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
        </form>
    </li>
    @parent
@endsection

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-sm-12">
                <h2>
                    {{ $metachannel->name }}
                    @if ($metachannel->public == 0)
                        <small><i title="private" class="glyphicon glyphicon-sunglasses"></i></small>
                    @endif
                    @if ($metachannel->listed == 0)
                        <small><i title="unlisted" class="glyphicon glyphicon-list"></i></small>
                    @endif
                    <small>(
                        @foreach($metachannel->channels as $channel)
                            <a href="{{ url('channel/'.$channel->ytid) }}">{{ $channel->name }}</a>{{ $loop->remaining ? ', ' : '' }}
                        @endforeach
                    )</small>
                </h2>
                @isset($metachannel->description)
                    <p class="m30">{{ $metachannel->description }}</p>
                @endisset
                @if($metachannel->user)
                    <p>{{__('by')}} <a href="{{ url('user/'.$metachannel->user->name) }}">{{ $metachannel->user->name }}</a></p>
                @endif
            </div>
        </div>
        <!-- Content -->
        <div class="row">
            @foreach($metachannel->videos() as $video)
                <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2" style="overflow-x: hidden;">
                    <a href="{{ url("video/$video->ytid?metachannel=$metachannel->id") }}">
                        <img src="https://img.youtube.com/vi/{{ $video->ytid }}/mqdefault.jpg" alt="">
                        <h3 class="header-margin-fix">{{ $video->name }}</h3>
                    </a>
                    <p><date data-date="{{ $video->uploaded_at }}">{{ $video->uploaded_at->format('d. F Y') }}</date> (<a href="{{ url('channel/'.$video->channel->ytid) }}">{{ $video->channel->name }}</a>)</p>
                    <p>{{ $video->description }}</p>
                    <hr class="visible-xs-block">
                </div>
            @endforeach
            @if (config('disqus.enabled'))
                <div id="disqus_thread" class="text-center" style="margin-top: 22px;">
                    <a class="btn btn-primary" style="display: inline-block; background: none;" href="#" onclick="disqus();return false;">Show Comments</a>
                </div>
            @endif
        </div>
    </div>
@endsection
