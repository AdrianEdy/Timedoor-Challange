<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

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

<body class="bg-lgray hold-transition skin sidebar-mini">
  <div class="wrapper">
    @yield('header')

    @yield('content')

    @yield('footer')
  </div>
</body>

@yield('modal')

@yield('script')

</html>