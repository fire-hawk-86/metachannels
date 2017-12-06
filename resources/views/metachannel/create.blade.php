@extends('layout')

@section('title', 'Create New Metachannel - ')

@section('content')
    <div class="container">

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

          <h1>Create New Metachannel</h1>
          <hr>

          <form method="POST" action="{{ url('meta') }}">

            <div class="form-group">
              <label name="name">Name:</label>
              <input id="name" name="name" class="form-control" value="{{ old('name') }}">
            </div>

            <div class="form-group">
              <label name="description">Description:</label>
              <textarea id="description" name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div id="channels" class="form-group">
              <label name="channels">Channels:</label>
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ old('name') }}">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ old('name') }}">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ old('name') }}">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ old('name') }}">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="{{ old('name') }}">
            </div>

            <input type="submit" value="Create Metachannel" class="btn btn-success btn-lg btn-block">
            <input type="hidden" name="_token" value="{{ Session::token() }}">

          </form>

        </div>
      </div>﻿

    </div>
@endsection
