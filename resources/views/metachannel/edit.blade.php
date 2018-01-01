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
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>{{ 'Edit '.$metachannel->name }}</h1>
                <hr>
                <form method="POST" action="{{ url("meta/$metachannel->id") }}">
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
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    <input type="text" name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="" placeholder="">
                    
                    <input type="submit" value="Update Metachannel" class="btn btn-success btn-lg btn-block">
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    {{ method_field('PUT') }}
                </form>
            </div>
        </div>﻿
    </div>
@endsection
