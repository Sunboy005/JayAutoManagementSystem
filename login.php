<?php
session_start();
//add connection
include "includes/connections/dbconnect.php";
if(isset($_SESSION['user'])){
  header("Location: admin/dashboard.php");
}
//login process
if (isset($_POST['signinUser'])) {      
  $username = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $salt = '5rte43dfghyt678'.$password;
  $hashed_password = md5($salt);                     
  $query = "SELECT * FROM users WHERE email = '$username' AND password = '$hashed_password'";
  $result = mysqli_query($conn, $query);
  //check if login is successful
  if (mysqli_num_rows($result) >= 1) {
      $row = mysqli_fetch_array($result);
      $_SESSION['user']=$row['email'];
      echo "<script>alert('User login successful');</script>";
      //check the user type and redirect to the appropriate page
      if($row['position_id']==1){
          header("Location: admin/dashboard.php");
      }else{
          header("Location: user/dashboard.php");
      }
  }else {
     echo "<script>alert('User Login Failed');</script>";
     header("location:login.php");
  }                                 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JayAuto | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Jay</b>Autos</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signinUser" class="btn btn-primary btn-block">Sign In</button>
            <?php echo $_SESSION['user'];?>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
