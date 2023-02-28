<?php

session_start();

require_once 'lib/data.php';

if (!isset($_SESSION['user'])) { header("LOCATION:login.php");exit; }

$name = $_SESSION['user']['name'];
$email = $_SESSION['user']['email'];
$avatar = $_SESSION['user']['avatar'];

$current_data = selectHomePageData();

if (isset($_POST['slogan-first-line'])) {

  $logo = $_FILES['logo'];
  $icon = $_FILES['icon'];
  $slogan_first_line = filter_var(addslashes($_POST['slogan-first-line']), FILTER_SANITIZE_STRING);
  $slogan_second_line = filter_var(addslashes($_POST['slogan-second-line']), FILTER_SANITIZE_STRING);
  $description = filter_var(addslashes($_POST['description']), FILTER_SANITIZE_STRING);
  $read_more = filter_var(addslashes($_POST['read-more']), FILTER_SANITIZE_URL);
  $user_id = $_SESSION['user']['id'];
  $last_update = date("D. d M Y");

  $logo_temp = $_FILES['logo']['tmp_name'];
  $logo_name = $_FILES['logo']['name'];

  $icon_temp = $_FILES['icon']['tmp_name'];
  $icon_name = $_FILES['icon']['name'];

  if ($_FILES['logo']['size'] > 4194304 || $_FILES['icon']['size'] > 4194304) {
    $message = 'There is a problem, please try again';
    $flag = ['danger', 'ban'];
  } else {
    $result = updateHomePageData($logo_name, $icon_name, $slogan_first_line, $slogan_second_line, $description, $read_more, $last_update, $user_id);
    
    if ($result) {
      $message = 'The data has been modified successfully';
      $flag = ['success', 'check'];
      header('refresh:2; url=home_page.php');
      move_uploaded_file($logo_temp, "upload/$logo_name");
      move_uploaded_file($icon_temp, "upload/$icon_name");
    }
    else {
      $message = 'There is a problem, please try again';
      $flag = ['danger', 'ban'];
    }
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="assets/dist/css/custom_style.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="../" target="_blank" class="nav-link">View RoboRave</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto mr-3">
<a href="logout.php">Logout</a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="upload/<?= $_SESSION['user']['avatar']; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="index.php" class="d-block"><?= $name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Portfolio</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="home_page.php" class="nav-link active">
              <i class="far fa-circle nav-icon"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="events.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Events</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="about.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>About Us</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="testimonials.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Testimonials</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="blog.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Blog</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="contact.php" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Contact Us</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Home</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

      <?php if(isset($flag)): ?>
      <div class="alert alert-<?= $flag[0]; ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-<?= $flag[1]; ?>"></i> Alert!</h5>
        <?= $message; ?>
      </div>
      <?php endif ?>

      <div class="callout callout-info">
        The last update was on <b><?= $current_data['last_update']; ?>
      </div>

        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Home Data</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="home_page.php" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputFile">Logo <span class="note">Max size 3MB</span></label>
                <div class="custom-image mt-2 mb-2">
                  <img src="upload/<?= $current_data['logo'] ?>" alt="">
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="logo" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="exampleInputFile">Icon <span class="note">16px × 16px is required</span></label>
                <div class="custom-image mt-2 mb-2">
                  <img src="upload/<?= $current_data['icon'] ?>" alt="">
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="icon" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label>First line of Slogan</label>
                <input type="text" class="form-control" name="slogan-first-line" placeholder="Enter ..." value="<?= $current_data['slogan_first_line']; ?>">
              </div>

              <div class="form-group">
                <label>Second Line of Slogan</label>
                <input type="text" class="form-control" name="slogan-second-line" placeholder="Enter ..." value="<?= $current_data['slogan_second_line']; ?>">
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."><?= $current_data['description']; ?></textarea>
              </div>

              <div class="form-group">
                <label>Read More link</label>
                <input type="text" class="form-control" name="read-more" placeholder="Enter ..." value="<?= $current_data['read_more_link']; ?>" >
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/dist/js/pages/dashboard.js"></script>
</body>
</html>