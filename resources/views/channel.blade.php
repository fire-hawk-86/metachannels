@extends('layout')

@section('title', $vid->snippet->title . ' - ')

@section('navbar')
    <li>
        <form method="POST" class="form-inline" style="margin-top: 8px" action="{{url('search')}}">
            <input name="query" class="form-control" type="text" placeholder="Search">
            <input class="form-control btn btn-default" type="submit" value="Send">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
    </li>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-12">
            
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">

        </div>
      </div>
    </div>
@endsection
