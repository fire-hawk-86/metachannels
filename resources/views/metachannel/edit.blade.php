@extends('layouts.app')

@section('title',  'Edit '.$metachannel->name.' - ')

@section('content')
    <div class="container">
        <!-- Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Content -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ url("meta/$metachannel->id") }}">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}

                    <div class="pull-right">
                        <input style="margin-right: 1rem;" name="public" type="checkbox" data-toggle="toggle" data-on="Public" data-off="Private" {{ $metachannel->public == 1 ? "checked" : "" }}>
                        &nbsp;
                        <input name="listed" type="checkbox" data-toggle="toggle" data-on="Listed" data-off="Unlisted" {{ $metachannel->listed == 1 ? "checked" : "" }}>
                    </div>

                    <h1>{{ 'Edit '.$metachannel->name }}</h1>
                    <hr>

                    <div class="form-group">
                        <label name="name" for="name">Name:</label>
                        <input id="name" name="name" class="form-control" value="{{ $metachannel->name }}">
                    </div>

                    <div class="form-group">
                        <label name="description" for="description">Description:</label>
                        <textarea id="description" name="description" rows="10" class="form-control">{{ $metachannel->description }}</textarea>
                    </div>

                    <p><label>Channels:</label></p>
                    @foreach ($metachannel->channels as $channel)
                        <div class="form-group">
                            <label>{{ $channel->name }}</label>
                            <input type="text" title="{{ $channel->name }}" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ url('https://www.youtube.com/channel/'.$channel->ytid) }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                        <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="">
                    </div>

                    <input type="submit" value="Update Metachannel" class="btn btn-success btn-lg btn-block">
                </form>
            </div>
        </div>﻿
    </div>
@endsection
