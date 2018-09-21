@extends('layouts.app')

@section('navbar')
    <li><a href="{{ url('meta/new') }}"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> {{__('New')}}</a></li>
    @parent
@endsection

@section('content')
    <div class="container">
        <!-- Header -->
        <div class="row">
            <div class="col-sm-12">
                <h2>{{ $title }}</h2>
                <hr>
            </div>
        </div>
        <!-- Content -->
        <div class="row">
            @foreach($metachannels as $metachannel)
                <div class="fixed-height2 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="overflow-x: hidden;">
                    <a href="{{ url("meta/$metachannel->id") }}">
                        @if($metachannel->videos()->isNotEmpty())
                            <img src="https://img.youtube.com/vi/{{ $metachannel->videos()->first()->ytid }}/mqdefault.jpg" alt="">
                        @else
                            <img src="http://via.placeholder.com/320x180" alt="">
                        @endif
                        <h3 class="header-margin-fix">
                            {{ $metachannel->name }}
                            @if ($metachannel->public == 0)
                                <small><i title="private" class="glyphicon glyphicon-sunglasses"></i></small>
                            @endif
                            @if ($metachannel->listed == 0)
                                <small><i title="unlisted" class="glyphicon glyphicon-list"></i></small>
                            @endif
                        </h3>
                    </a>
                    @if($metachannel->user)
                        <p>{{__('Created by')}}: <a href="{{ url('user/'.$metachannel->user->name) }}">{{ $metachannel->user->name }}</a></p>
                    @else
                        <p>{{__('Created by')}}: {{__('Guest')}}</p>
                    @endif
                    <p>
                        Channels:
                        @foreach($metachannel->channels as $channel)
                            <a href="{{ url('channel/'.$channel->ytid) }}">{{ $channel->name }}</a>{{ $loop->remaining ? ', ' : '' }}
                        @endforeach
                    </p>
                    <hr class="visible-xs-block">
                </div>
            @endforeach
        </div>
    </div>
@endsection
