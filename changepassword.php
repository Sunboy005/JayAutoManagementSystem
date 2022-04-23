<?php
session_start();
//add connection
include "includes/connections/dbconnect.php";
if(isset($_SESSION['user'])){
    header("Location: general/dashboard.php");
  }
  if(!isset($_SESSION['usernew'])){
    header("Location: index.php");
  }
  //login process
if (isset($_POST['changepass'])) {     
    $useremail =  $_SESSION['usernew'];
    $passwordn=$_POST["password"];
    $salt = '5rte43dfghyt678'.$passwordn;
    $hashedp= md5($salt);            
    $date=date("Y-m-d h:i:s");
    $sql = "UPDATE users SET  date_updated='$date', status_id=1, password='$hashedp' WHERE email='$useremail'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $_SESSION['alerticon']="success";
        $_SESSION['alert']="Password  set successfully";
      header("Location: index.php");
    }
    else{
        $_SESSION['alerticon']="danger";
        $_SESSION['alert']="Password  not set";
    }                  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>JayAuto | Set Password</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body class="hold-transition login-page">
    <?php include "includes/pages/general/alert.php"; ?>

<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>Jay</b>Autos</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Enter New Password</p>
      <br />
      <li class="list-unstyled"><span id="cpass-validate" style="font-size:12px;"></span></li>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-code  text-primary"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="cpassword" id="cpassword" class="form-control" placeholder="Confirm Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-code  text-primary"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-2">
          </div>
          <!-- /.col -->
          <div class="col-8">
            <button type="submit" name="changepass" class="btn btn-primary btn-block">Confirm Employment</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<?php include 'includes/pages/general/footer-script.php'; ?>
</body>
</html>
<script type="text/javascript">
$('#cpassword').on('change', function () {  
  if ($('#password').val() != $('#cpassword').val()) {
    $('#cpass-validate').html('Password not The same with the confirm password').css('color', 'red');
    
    $_SESSION['checker'] = false;
  }
    $_SESSION['checker'] = true;
});
</script>