@extends('layouts.app')

@section('title', 'Create New Metachannel - ')

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
                <form method="POST" action="{{ url('meta') }}">
                    {{ csrf_field() }}

                    <div class="pull-right">
                        <input name="public" type="checkbox" checked data-toggle="toggle" data-on="Public" data-off="Private">
                    </div>

                    <h1>Create New Metachannel</h1>
                    <hr>

                    <div class="form-group">
                        <label name="name" for="name">Name:</label>
                        <input id="name" name="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label name="description" for="description">Description:</label>
                        <textarea id="description" name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div id="channels" class="form-group">
                        <label name="channels">Channels:</label>
                        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/channel/example" value="{{ old('channels.0') }}">
                        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/channel/example" value="{{ old('channels.1') }}">
                        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/channel/example" value="{{ old('channels.2') }}">
                        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/channel/example" value="{{ old('channels.3') }}">
                        <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/channel/example" value="{{ old('channels.4') }}">
                    </div>

                    <input type="submit" value="Create Metachannel" class="btn btn-success btn-lg btn-block">
                </form>
            </div>
        </div>﻿
    </div>
@endsection
