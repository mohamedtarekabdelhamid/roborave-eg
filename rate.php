<?php

require_once 'dashboard/lib/data.php';

$home = selectHomePageData();

if (isset($_POST['name'])) {

  $name = filter_var(addslashes($_POST['name']), FILTER_SANITIZE_STRING);
  $feedback = filter_var(addslashes($_POST['feedback']), FILTER_SANITIZE_STRING);
  $rate = $_POST['rate'];
  $email = filter_var(addslashes($_POST['email']), FILTER_SANITIZE_EMAIL);

  if (empty($name) || empty($feedback) || empty($rate) || (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
    $message = 'There is a problem, please try again';
    $flag = ['danger', 'ban'];
  }
  
  else {
    $avatar_tmp = $_FILES['avatar']['tmp_name'];
    $avatar_ext = empty($_FILES['avatar']['type']) ? 'png' : explode('/', $_FILES['avatar']['type'])[1];

    $email = empty($_FILES['avatar']['name']) ? 'default' : $_POST['email'];
  
    $avatar = explode('@', $email)[0] . '.' . $avatar_ext;

    $formats = ['jpg', 'gif', 'jpeg', 'png'];

    
    if (!in_array($avatar_ext, $formats) || $_FILES['avatar']['size'] > 4194304) {
      $message = 'There is a problem, please try again';
      $flag = ['danger', 'ban'];
    } else {
      $result = insertRate($name, $feedback, $rate, $avatar);
      if ($result) {
        $message = 'The Event has been added successfully';
        $flag = ['success', 'check'];
        move_uploaded_file($avatar_tmp, "dashboard/upload/$avatar");
        header('refresh:2; url=index.php');
      } else {
        $message = 'There is a problem, please try again';
        $flag = ['danger', 'ban'];
      }
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoboRave - Egypt</title>
    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="dashboard/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="dashboard/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="dashboard/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="dashboard/assets/plugins/jqvmap/jqvmap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dashboard/assets/dist/css/adminlte.css">
  <!-- overlayScrollbars -->
  <!-- Daterange picker -->
  <!-- summernote -->
  <!-- Custom Styles -->
  <link rel="stylesheet" href="dashboard/assets/dist/css/custom_style.css">

  <link rel="stylesheet" href="assets/css/normalize.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="icon" href="dashboard/upload/<?= $home['icon']; ?>" type="image/x-icon"/>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

</head>
<body>
  <!-- Header -->
  <header class="no-fixed wow animate__animated animate__fadeInDown" data-wow-delay="2s">
    <div class="container">
      <div class="logo">
          <a href="index.php"><img src="dashboard/upload/<?= $home['logo']; ?>" alt="RoboRave"></a>
      </div>
      <nav>
          <ul>
              <li class=""><a href="index.php#home" data-scroll>home</a></li>
              <li><a href="index.php#events" data-scroll>events</a></li>
              <li><a href="index.php#about-us" data-scroll>about us</a></li>
              <li><a href="index.php#testimonial" data-scroll>testimonial</a></li>
              <li><a href="index.php#blog" data-scroll>blog</a></li>
              <li><a href="index.php#contact-us" data-scroll>contact us</a></li>
          </ul>
      </nav>

      <!-- Navbar for mobile screens -->
      <nav class="mobile">
        <div class="icon" onclick="show_hide()">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <ul id="menu" hidden>
          <li><a href="#home">home</a></li>
          <li><a href="#events">events</a></li>
          <li><a href="#about-us">about us</a></li>
          <li><a href="#testimonial">testimonial</a></li>
          <li><a href="#blog">blog</a></li>
          <li><a href="#contact-us">contact us</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="rate-page content mt-4">
      <div class="container">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">

          <?php if(isset($flag)): ?>
          <div class="alert alert-<?= $flag[0]; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-<?= $flag[1]; ?>"></i> Alert!</h5>
            <?= $message; ?>
          </div>
          <?php endif ?>
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header ground">
                <h3 class="card-title">Rate</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="rate.php" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Name*</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter ...">
                  </div>
                  <div class="form-group">
                    <label>Email*</label>
                    <input type="text" name="email" class="form-control" placeholder="Enter ...">
                  </div>


                  <div class="form-group">
                    <label for="exampleInputFile">Your Photo <span class="note">Max size 3MB</span></label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="avatar">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>

                  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalLabel">Crop image</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="img-container">
                            <div class="row">
                              <div class="col-md-8">  
                                  <!--  default image where we will set the src via jquery-->
                                  <img id="image">
                              </div>
                              <div class="col-md-4">
                                  <div class="preview"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-primary" id="crop">Crop</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Feedback*</label>
                    <textarea class="form-control" name="feedback" rows="3" maxlength="200" placeholder="Enter ..."></textarea>
                  </div>

                  <div class="form-group">
                    <label>Number of Stars*</label>
                    <select class="form-control" name="rate">
                      <option value="1">1 Star</option>
                      <option value="2">2 Stars</option>
                      <option value="3">3 Stars</option>
                      <option value="4">4 Stars</option>
                      <option value="5">5 Stars</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary ground">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>


  <!-- jQuery -->
  <script src="dashboard/assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="dashboard/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jquery-validation -->
  <script src="dashboard/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="dashboard/assets/plugins/jquery-validation/additional-methods.min.js"></script>

  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../../dist/js/demo.js"></script>

</body>
</html>