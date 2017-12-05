<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')Metachannels</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="/favicon.ico"/>
    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-default">
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
          </ul>
        </div>

      </div>
    </nav>

    @yield('content')
    
    <!-- JS -->
    <script src="/js/jquery-3.2.1.js"></script>
    <script src="/js/bootstrap.js"></script>
  </body>
</html>
