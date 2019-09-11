<html>
  <head>
    <title>Timedoor Challenge - Level 8</title>
    @include('template/style')
    @include('template/script')
    <meta name="_token" content="{{ csrf_token() }}">
  </head>

  <body class="bg-lgray">
    @yield('content')
  </body>
</html>