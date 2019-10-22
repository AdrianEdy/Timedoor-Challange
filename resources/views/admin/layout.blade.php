<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="_token" content="{{ csrf_token() }}">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <title>Timedoor Admin | Dashboard</title>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('plugin/bootstrap/bootstrap.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugin/font-awesome/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('plugin/Ionicons/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
  <!-- TMDR Preset -->
  <link rel="stylesheet" href="{{ asset('css/tmdrPreset.css') }}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
  <!-- Skin -->
  <link rel="stylesheet" href="{{ asset('css/skin.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('plugin/bootstrap-datepicker/bootstrap-datetimepicker.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugin/daterangepicker/daterangepicker.css') }}">
  <!-- DataTable -->
  <link rel="stylesheet" href="{{ asset('plugin/datatable/datatables.min.css') }}">
  <!-- DataTable -->
  <link rel="stylesheet" href="{{ asset('plugin/selectpicker/bootstrap-select.css') }}">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- Javascript -->
  <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
  <!-- Javascript End -->
</head>

<body class="bg-lgray hold-transition skin sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>T</b>D</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Timedoor</b> Admin</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs">Hello, {{ Auth::user()->name }} </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{ asset('img/user-ico.jpg') }}" class="img-circle" alt="User Image">
                  <p>
                    {{ Auth::user()->name }}
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="text-right">
                    <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <?php $page = 'home' ?>
          <li class="<?php if ($page == 'home') { echo 'active'; } ?>">
            <a href="index.php"><i class="fa fa-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
      </section>

      @yield('content')

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 0.1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="https://timedoor.net" class="text-green">Timedoor Indonesia</a>.</strong>
        All
        rights
        reserved.
      </footer>
</body>


<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Close</span></button>
        <div class="text-center">
          <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
        </div>
      </div>
      <div class="modal-body pad-20">
        <p>Are you sure want to delete this item(s)?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="formDeleteBtn" onclick="deleteBoard()" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
</div>

@yield('script');

</html>