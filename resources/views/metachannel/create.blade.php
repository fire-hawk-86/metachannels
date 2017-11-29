@extends('layout')

@section('content')
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <h1>Create New Metachannel</h1>
          <hr>

          <form method="POST" action="{{ route('metachannels.store') }}">

            <div class="form-group">
              <label name="name">Name:</label>
              <input id="name" name="name" class="form-control">
            </div>

            <div class="form-group">
              <label name="description">Description:</label>
              <textarea id="description" name="description" rows="10" class="form-control"></textarea>
            </div>

            <input type="submit" value="Create Metachannel" class="btn btn-success btn-lg btn-block">
            <input type="hidden" name="_token" value="{{ Session::token() }}">

          </form>

        </div>
      </div>﻿

    </div>
@endsection
