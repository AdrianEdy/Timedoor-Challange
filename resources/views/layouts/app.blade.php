<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    @yield('title')

    @yield('style')

    @yield('script')

    <meta name="_token" content="{{ csrf_token() }}">
  </head>

  <body class="bg-lgray">
    @if(!(Request::is('login')      || 
          Request::is('register')   || 
          Request::is('register/*') || 
          Request::is('email')      || 
          Request::is('email/*')))
            @yield('header')
    @endif

    @yield('content')

  </body>

  @if(!(Request::is('login')      || 
        Request::is('register')   || 
        Request::is('register/*') || 
        Request::is('email')      || 
        Request::is('email/*')))
          @yield('footer')
  @endif

  @yield('modal')

  @section('footer-script')
</html>