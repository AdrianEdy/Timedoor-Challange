<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    @yield('title')

    @yield('style')

    @yield('script')

    <meta name="_token" content="{{ csrf_token() }}">
  </head>

<body class="bg-lgray hold-transition skin sidebar-mini">  
<div class="wrapper">
    @yield('header')

    @yield('content')
    
    @yield('footer')
</div>

  @yield('modal')

  @yield('footer-script')
  <script>
    //alert('ooii');
  </script>
</html>