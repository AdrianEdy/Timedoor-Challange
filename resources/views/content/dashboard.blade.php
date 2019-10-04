  @section('title')
    <title>Timedoor Admin | Dashboard</title>
  @endsection

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
  
  <body class="hold-transition skin sidebar-mini">
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
                  <span class="hidden-xs">Hello, Admin </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="img/user-ico.jpg" class="img-circle" alt="User Image">
                    <p>
                      Administrator
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="text-right">
                      <a href="login.php" class="btn btn-danger btn-flat">Sign out</a>
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
        <?php include 'template/sidebar.php' ?>
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
                <form method="" action="">
                  <div class="box-body">
                    <div class="bordered-box mb-20">
                      <form class="form" role="form">
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
                      </form>
                    </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th><input type="checkbox"></th>
                          <th>ID</th>
                          <th>Title</th>
                          <th>Body</th>
                          <th width="200">Image</th>
                          <th>Date</th>
                          <th width="50">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><input type="checkbox"></td>
                          <td>330</td>
                          <td>Lorem Ipsum</td>
                          <td>Lorem ipsum dolor sit amet, consectar bla bla bla...</td>
                          <td>
                            <img class="img-prev" src="https://via.placeholder.com/500x500">
                            <a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger ml-10 btn-img" rel="tooltip" title="Delete Image"><i class="fa fa-trash"></i></a>
                          </td>
                          <td>2014/7/9<br><span class="small">13:59:00</span></td>
                          <td><a href="#" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger" rel="tooltip" title="Delete"><i class="fa fa-trash"></i></a></td>
                        </tr>
                        <tr class="bg-gray-light">
                          <td>&nbsp;</td>
                          <td>331</td>
                          <td>Lorem Ipsum</td>
                          <td>Lorem ipsum dolor sit amet, consectar bla bla bla...</td>
                          <td>
                            -
                          </td>
                          <td>2014/7/9<br><span class="small">13:59:00</span></td>
                          <td><a href="#" class="btn btn-default" rel="tooltip" title="Recover"><i class="fa fa-repeat"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                    <a href="#" class="btn btn-default mt-5" data-toggle="modal" data-target="#deleteModal">Delete Checked Items</a>
                    <div class="text-center">
                      <nav>
                        <ul class="pagination">
                          <li><a href="#">&laquo;</a></li>
                          <li class="active"><a href="#">1</a></li>
                          <li><a href="#">2</a></li>
                          <li><a href="#">3</a></li>
                          <li><a href="#">&raquo;</a></li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </form>
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
              <button type="button" class="btn btn-danger">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include('template/script.php') ?>

    <script>
      // BOOTSTRAP TOOLTIPS
      if ($(window).width() > 767) {
        $(function () {
          $('[rel="tooltip"]').tooltip()
        });
      };
    </script>
  </body>
</html>
