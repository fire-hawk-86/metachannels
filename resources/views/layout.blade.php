<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')Metachannels</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><span class="label label-danger lb-lg">Meta</span> Channels</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            @yield('navbar')

            @if (Auth::guest())
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-user"></span>  Login
                  </a>
                    <div class="dropdown-menu custom-dropdown-form">
                      <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                          <input name="email" class="form-control" placeholder="email">
                        </div>
                        <div class="form-group">
                          <input name="password" class="form-control" type="password" placeholder="password">
                        </div>
                        <div class="form-group">
                          <input class="form-control btn btn-primary btn-block" type="submit" value="Login">
                        </div>
                        <a style="display: block; font-size: 12px" class="text-right" href="{{ route('register') }}">Register</a>
                      </form>
                    </div>
                </li>
                <!--<li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>-->
            @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
          </ul>
        </div>

      </div>
    </nav>

    @yield('content')

    <footer class="navbar navbar-default navbar-static-bottom">
      <div class="container">
        <a href="{{url('info')}}" class="navbar-text" style="color: #aaa; margin-left: 0;">Why this Website?</a>
      </div>
    </footer>
    <!-- JS -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
