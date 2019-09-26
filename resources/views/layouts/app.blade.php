<html>
  <head>
    <title>Timedoor Challenge - Level 8</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tmdrPreset.css') }}">
    <!-- CSS End -->

    <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Javascript End -->

    <meta name="_token" content="{{ csrf_token() }}">
  </head>

  <body class="bg-lgray">
    @if(!(Request::is('login')      || 
          Request::is('register')   || 
          Request::is('register/*') || 
          Request::is('email')      || 
          Request::is('email/*')))
      <header>
        <nav class="navbar navbar-default" role="navigation">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" 
              data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <h2 class="font16 text-green mt-15"><b>Timedoor 30 Challenge Programmer</b></h2>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
              @guest
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
              @else
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </li>
              @endguest
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
      </header>
    @endif

    @yield('content')

  </body>

  @if(!(Request::is('login')      || 
        Request::is('register')   || 
        Request::is('register/*') || 
        Request::is('email')      || 
        Request::is('email/*')))
    <footer>
        <p class="font12">Copyright &copy; 
        <script>document.write(new Date().getFullYear());</script> by 
        <a href="https://timedoor.net" class="text-green">PT. TIMEDOOR INDONESIA</a></p>
    </footer>
  @endif

  @yield('modal')

</html>