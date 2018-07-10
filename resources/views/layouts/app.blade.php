<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title'){{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <!-- Toggle -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Brand -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span class="label label-danger lb-lg">Meta</span> Channels
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @section('navbar')
                            @if (Auth::guest())
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <span class="glyphicon glyphicon-user"></span> {{__('Login')}}
                                    </a>
                                    <div class="dropdown-menu custom-dropdown-form">
                                        <form method="POST" action="{{ route('login') }}">
                                            {{ csrf_field() }}
                                            <div class="form-group">
                                                <input name="email" class="form-control" placeholder="Email">
                                            </div>
                                            <div class="form-group">
                                                <input name="password" class="form-control" type="password" placeholder="{{__('Password')}}">
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control btn btn-primary btn-block" type="submit" value="{{__('Login')}}">
                                            </div>
                                            <a style="display: block; font-size: 12px" class="text-right" href="{{ route('register') }}">{{__('Register')}}</a>
                                        </form>
                                    </div>
                                </li>
                            @else
                                <li class="dropdown">
                                    <!-- Dropdown -->
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        <span class="glyphicon glyphicon-user"></span> {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <!-- Remove Account -->
                                        <li>
                                            <a href="#" title="and all metachannels created with it"
                                                onclick="event.preventDefault();
                                                         document.getElementById('remove-user-form').submit();">
                                                {{__('Remove Account')}}
                                            </a>
                                            <form id="remove-user-form" action="{{ url( 'user/'.Auth::id() ) }}" method="POST" style="display: none;">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                        <!-- Divider -->
                                        <li class="divider"></li>
                                        <!-- Logout -->
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                {{__('Logout')}}
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        @show
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Alerts Session-->
                        @if (session('message'))
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                {{ session('message') }}
                            </div>
                        @endif
                        <!-- Alerts -->
                        @if (isset($message))
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                                {{ $message }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="navbar navbar-default navbar-static-bottom">
            <div class="container">
                <!-- Left Footer -->
                <span class="navbar-text pull-left">
                    <a href="{{url('info')}}">Why this Website?</a>
                    <i>|</i>
                    <a href="https://github.com/fire-hawk-86/metachannels">Github</a>
                    <i>|</i>
                    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EYTZMVK7XVRJE" target="_blank">Donate</a>
                    <i>|</i>
                    <a href="mailto:info@metachannels.ga">Contact</a>
                </span>
                <!-- Right Footer -->
                <span class="navbar-text pull-right">
                    Created with Laravel 5
                    <i>/</i>
                    Bootstrap 3
                </span>
            </div>
        </footer>
    </div>
    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
