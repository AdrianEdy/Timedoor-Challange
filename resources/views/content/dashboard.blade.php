@extends('layouts.app')

@section('title')
  <title>Timedoor Admin | Dashboard</title>
@endsection

@section('style')
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="plugin/bootstrap/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugin/font-awesome/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/Ionicons/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="css/admin.css">
  <!-- TMDR Preset -->
  <link rel="stylesheet" href="css/tmdrPreset.css">
  <!-- Custom css -->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Skin -->
  <link rel="stylesheet" href="css/skin.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="plugin/bootstrap-datepicker/bootstrap-datetimepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugin/daterangepicker/daterangepicker.css">
  <!-- DataTable -->
  <link rel="stylesheet" href="plugin/datatable/datatables.min.css">
  <!-- DataTable -->
  <link rel="stylesheet" href="plugin/selectpicker/bootstrap-select.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('content')
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
                <img src="img/user-ico.jpg" class="img-circle" alt="User Image">
                <p>
                  {{ Auth::user()->name }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="text-right">
                      <a class="btn btn-danger btn-flat" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12"><!-- /.col-xs-12 -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h1 class="font-18 m-0">Timedoor Challenge - Level 9</h1>
            </div>
              <div class="box-body">
                <div class="bordered-box mb-20">
                    <table class="table table-no-border mb-0">
                      <tbody>
                        <tr>
                          <td width="80"><b>Title</b></td>
                          <td><div class="form-group mb-0">
                            <input type="text" class="form-control">
                            </div></td>
                        </tr>
                        <tr>
                          <td><b>Body</b></td>
                          <td><div class="form-group mb-0">
                            <input type="text" class="form-control">
                            </div></td>
                        </tr>
                      </tbody>
                    </table>
                    <table class="table table-search">
                      <tbody>
                        <tr>
                          <td width="80"><b>Image</b></td>
                          <td width="60">
                            <label class="radio-inline">
                              <input type="radio" name="imageOption" id="inlineRadio1" value="option1"> with
                            </label>
                          </td>
                          <td width="80">
                            <label class="radio-inline">
                              <input type="radio" name="imageOption" id="inlineRadio2" value="option2"> without
                            </label>
                          </td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="imageOption" id="inlineRadio3" value="option3" checked> unspecified
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td width="80"><b>Status</b></td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="statusOption" id="inlineRadio1" value="option1"> on
                            </label>
                          </td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="statusOption" id="inlineRadio2" value="option2"> delete
                            </label>
                          </td>
                          <td>
                            <label class="radio-inline">
                              <input type="radio" name="statusOption" id="inlineRadio3" value="option3" checked> unspecified
                            </label>
                          </td>
                        </tr>
                        <tr>
                          <td><a href="#" class="btn btn-default mt-10"><i class="fa fa-search"></i> Search</a></td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <form id="formTable" method="POST">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th><input type="checkbox" onclick="toggle(this)"></th>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Body</th>
                      <th width="200">Image</th>
                      <th>Date</th>
                      <th width="50">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @csrf
                  @foreach ($boards as $board)
                    <tr {!! $board->trashed() ? "class='bg-gray-light'" : '' !!}>
                      <td>{!! $board->trashed() ? "&nbsp;" : "
                        <input type='checkbox' value='$board->id' name='checked[]'>" !!}
                      </td>
                      <td>{{ $board->id }}</td>
                      <td>{{ $board->title }}</td>
                      <td>{!! nl2br(e($board->message)) !!}</td>
                      <td>
                        @if (!is_null($board->image) && 
                            file_exists('storage/image/board/thumbnail/' . $board->image))
                            <img class="img-prev" style="width:130px"
                            src="{{ url('storage/image/board/thumbnail/' . $board->image) }}" alt="image">
                            <a id="deleteImage" onclick="destroyImage()" href="#" data-toggle="modal" 
                            data-target="#deleteModal" data-id="{{ $board->id }}" 
                            class="btn btn-danger ml-10 btn-img" rel="tooltip" title="Delete Image">
                              <i class="fa fa-trash"></i>
                            </a>
                        @else
                            -
                        @endif
                      </td>
                      <td>{{ date('Y/m/d', strtotime($board->created_at)) }}<br>
                      <span class="small">{{ date('H:i:s', strtotime($board->created_at)) }}</span></td>
                      @if ($board->trashed())
                          <td><button formaction="{{ route('dashboard.restore', $board->id )}}"
                          class="btn btn-default" rel="tooltip" title="Recover">
                            <i class="fa fa-repeat"></i>
                          </button></td>
                      @else
                        <td><a id="delete" onclick="destroy()" href="#" data-id="{{ $board->id }}"
                        data-toggle="modal" data-target="#deleteModal" 
                        class="btn btn-danger" rel="tooltip" title="Delete">
                          <i class="fa fa-trash"></i>
                        </a></td>
                      @endif
                    </tr>
                  @endforeach
                  </tbody>
                </table>
                </form>
                <a id="deleteCheck" href="#" onclick="destroyMultiple()" 
                class="btn btn-default mt-5" data-toggle="modal" 
                data-target="#deleteModal">Delete Checked Items</a>
                <div class="text-center">
                  {{ $boards->links() }}
                </div>
              </div>
          </div>
        </div><!-- /.col-xs-12 -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 0.1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="https://timedoor.net" class="text-green">Timedoor Indonesia</a>.</strong> All rights
    reserved.
  </footer>


  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
@endsection

@section('script')
  <!-- jQuery 3 -->
  <script src="plugin/jquery/jquery.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugin/jquery/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="plugin/bootstrap/bootstrap.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugin/moment/moment.min.js"></script>
  <script src="plugin/daterangepicker/daterangepicker.js"></script>
  <!-- datepicker -->
  <script src="plugin/bootstrap-datepicker/bootstrap-datetimepicker.js"></script>
  <!-- AdminLTE App -->
  <script src="js/adminlte.min.js"></script>
  <!-- DataTable -->
  <script src="plugin/datatable/datatables.min.js"></script>
  <!-- CKEditor -->
  <script src="plugin/ckeditor/ckeditor.js"></script>
  <!-- Selectpicker -->
  <script src="plugin/selectpicker/bootstrap-select.js"></script>
@endsection

@section('footer-script')
    <script>
      // BOOTSTRAP TOOLTIPS
      if ($(window).width() > 767) {
        $(function () {
          $('[rel="tooltip"]').tooltip()
        });
      };
      
      // DISPLAY MODAL WITH FORM ACTION
      function destroyImage() {
        id = document.getElementById("deleteImage").dataset.id;
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy/image/" + id;
      }

      function deleteBoard() {
          document.getElementById("formTable").submit();
      }

      function destroy() {
        id = document.getElementById("delete").dataset.id;
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy/" + id;
      }

      function destroyMultiple() {
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy-multiple";
      }

      function toggle(source) {
        boxes = document.getElementsByName("checked[]");

        for(var i = 0, n = boxes.length; i<n; i++) {
          boxes[i].checked = source.checked;
        }
      }
    </script>
    @if (Session::has('bruh'))
    <script>
        alert("{{Session::get('bruh')}}");
    </script>
    @endif
@endsection
