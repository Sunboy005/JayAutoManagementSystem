<?php
  if(isset($_SESSION['alert'])){
    $alerticon=$_SESSION['alerticon'];
    $alertmessage=$_SESSION['alert'];
    echo '<script type="text/javascript">swal()</script>';
    // unset($_SESSION['alerticon']);
    // unset($_SESSION['alert']);
  }
?>