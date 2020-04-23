@extends('layouts.app')

@section('title', 'What is Metachannels - ')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>Why Metachannels??</h1>
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
                @if (config('disqus.enabled'))
                    <div id="disqus_thread" class="text-center" style="margin-top: 22px;">
                        <a class="btn btn-primary" style="display: inline-block; background: none;" href="#" onclick="disqus();return false;">Show Comments</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
