@extends('layout')

@section('title',  'Edit '.$metachannel->name.' - ')

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

          <h1>{{ 'Edit '.$metachannel->name }}</h1>
          <hr>

          <form method="POST" action="{{ url('meta/'.$metachannel->id) }}">

            <div class="form-group">
              <label name="name">Name:</label>
              <input id="name" name="name" class="form-control" value="{{ $metachannel->name }}">
            </div>

            <div class="form-group">
              <label name="description">Description:</label>
              <textarea id="description" name="description" rows="10" class="form-control">{{ $metachannel->description }}</textarea>
            </div>

            <input type="submit" value="{{ 'Update '.$metachannel->name }}" class="btn btn-success btn-lg btn-block">
            <input type="hidden" name="_token" value="{{ Session::token() }}">
            {{ method_field('PUT') }}

          </form>

        </div>
      </div>﻿

    </div>
@endsection
