@extends('layout')

@section('title', 'What is Metachannels - ')

@section('navbar')
    <li>
        <form method="POST" class="form-inline" style="margin-top: 8px" action="{{url('search')}}">
            <input type="text" name="query" class="form-control" placeholder="Search">
            <input type="submit" class="form-control btn btn-default" value="Send">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
        </form>
    </li>
@endsection

@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Why Metachannels?</h1>
            <hr>
            <p>
                Because Youtube became more and more uncomfortable for me to use over the years.
                I was looking for a solution.
            </p>
            <p>
                This Website solves multiple Problems I have with Youtube, here are some examples:
                <ul>
                    <li>Being annoyed by recommended Videos instead of just seeing related Videos</li>
                    <li>Being able to organize the channels you watch in a better way than just one pile of all kinds of different channels</li>
                    <li>Not wanting to use a Google Account</li>
                </ul>
            </p>
        </div>
      </div>
    </div>
@endsection
