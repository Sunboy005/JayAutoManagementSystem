<?php
session_start();
$pagename="Employee List";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/connections/data.php";
include "../includes/pages/general/head-top.php";
//Delete a Vehicle
if(isset($_GET['del'])){
	$query=mysqli_query($conn,"DELETE FROM  users WHERE id = '".$_GET['id']."'");
  if($query){
    $_SESSION['alerticon'] ='success';
    $_SESSION['alert'] ='Employee Deleted successfully';
    header("Location:employees.php");
  }else{
    $_SESSION['alerticon'] ='danger';
    $_SESSION['alert'] ='Employee Failed to Add';
  } 		
}
//Set Status
if(isset($_GET['status'])){
  $statustoset = $_GET['status'];
	$query=mysqli_query($conn,"UPDATE users SET status_id = '$statustoset' WHERE id = '".$_GET['id']."'");
  if($query){
    $_SESSION['alerticon'] ='success';
    $_SESSION['alert'] ='Status Changed successful';
    header("Location:employees.php");
  }else{
    $_SESSION['alerticon'] ='danger';
    $_SESSION['alert'] ='Status Change Failed';
  } 		
}

//Set Position
if(isset($_GET['upgrade'])){
  $upgradetoset = $_GET['upgrade'];
	$query=mysqli_query($conn,"UPDATE users SET position_id = '$upgradetoset' WHERE id = '".$_GET['id']."'");
  if($query){
    $_SESSION['alerticon'] ='success';
    $_SESSION['alert'] ='Position Changed successful';
    header("Location:employees.php");
  }else{
    $_SESSION['alerticon'] ='danger';
    $_SESSION['alert'] ='Position Failed Update';
  } 		
}

//Add Vehicle process
if(isset($_POST['addemployee'])){
  $name=$_POST['fullname'];
  $position_id=$_POST['position'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
  $date=date('Y-m-d h:i:s');

  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="INSERT INTO users (name, email, phone, position_id, status_id, date_created) VALUES ('$name','$email','$phone','$position_id','3','$date')";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
    $_SESSION['alerticon'] ='success';
    $_SESSION['alert'] ='Employee Added successful';
    header("Location: employees.php");
  }else{
    $_SESSION['alerticon'] ='danger';
    $_SESSION['alert'] ='EmployeeFailed to Add';
    header("Location: employees.php");
      die('Error: ' . mysqli_error($conn));
  }
}

?>
 <!-- DataTables -->
 <?php include '../includes/pages/general/table-css.php'; ?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
 <!-- Navbar -->
 <?php include "../includes/pages/general/navigation.php";?>
  <!-- Main Sidebar Container -->

  <?php include "../includes/pages/general/sidebar.php";?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php include "../includes/pages/general/breadcrumb.php";?>

        <!-- Main content -->
   <section class="content">
       <div class="container-fluid">
       <?php include "../includes/pages/general/alert.php"; ?>
       <div class="row mr-4">
          <div class="col-sm-3">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Employee</h3>
                <br />                
                <li class="list-unstyled"><span id="email-availability-status" style="font-size:12px;"></span></li>
                <li class="list-unstyled"><span id="phone-availability-status" style="font-size:12px;"></span></li>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                  <div class="input-group mb-3">
                    <input type="text" name="fullname" class="form-control" placeholder="fullname" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control" onblur="checkEmail()" placeholder="Email" id="email" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="text" name="phone" class="form-control" onblur="checkPhone()" placeholder="Phone number" id="phone" required>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <select name="position" class="form-control" required>
                      <option disabled selected>Choose Position</option>
                      <?php
                      $sql ="SELECT * FROM position";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                      ?>
                      <option value="<?php echo $row['id']; ?>" >
                      <?php echo $row['title']; ?>
                      </option>
                      <?php } ?>  
                    </select>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-list"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2">

                    </div>
                    <!-- /.col -->
                    <div class="col-8">
                      <button type="submit" name="addemployee" class="btn btn-primary btn-block"><small><i class="fas fa-plus"></i></small><i class="fas fa-user"></i> Add Employee</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
        </div>
        <div class="col-sm-9">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Employee List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Phone No</th>
                    <th>Position</th>
                    <th>Car Sold</th>
                    <th>Amount($)</th>
                    <th>Action</th>
                    <th><i class= "fas fa-arrow-up text-success"></i><i class="fas fa-arrow-down text-danger"></i></th>
                    <th>Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                                  $cnt=1;
                                  $sql1 ="SELECT * FROM users";
                                  $result1 = mysqli_query($conn, $sql1);
                                  $count=mysqli_num_rows($result1);
                                  while($row1 = mysqli_fetch_array($result1)){                                          
                              if ($count==0) {
                                $count++;
                              echo '<tr>
                                      <td>No employee to display</td>
                                    </tr>';		            
                              }else{                                
                                $userid=$row1['id'];                            
                                $positionid=$row1['position_id'];                            
                                $statusid=$row1['status_id'];      
                              ?>
                                  <tr>                  
                                      <?php echo '<td>'.$cnt.'</td>';?>
                                      <td><?php echo $row1['name']; ?></td>
                                      <td><?php echo $row1['phone']; ?></td>
                                      <?php $query ="SELECT * FROM position WHERE id='$positionid'";
                                      $result3 = mysqli_query($conn, $query);
                                      while($row3 = mysqli_fetch_array($result3)){  ?> 
                                          <td><?php echo $row3['title']; ?></td>
                                      <?php }
                                          $sql2 = "SELECT SUM(quantity * unit_selling_price) AS sum_amount, SUM(quantity) AS total_quantity FROM vehiclesales WHERE sold_by ='$userid'";
                                          $result2 = mysqli_query($conn, $sql2);
                                          $counter= mysqli_num_rows($result2);
                                          while($row2 = mysqli_fetch_array($result2)){   
                                      ?>  
                                      <td><?php echo $row2['total_quantity'] + 0;?></td>
                                      <td><?php echo $row2['sum_amount'] + 0;?></td>     
                                      <td>
                                      <?php if($statusid==1){?>
                                          <a href="employees.php?id=<?php echo $userid?>&status=2" onClick="return confirm('Are you sure you want to deactivate the account?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Deactivate"><button class="btn btn-secondary btn-xs"><i class="fas fa-toggle-off"></i></button></a>                                                                                                             
                                            <?php }else if($statusid==2){?>
                                          <a href="employees.php?id=<?php echo $userid?>&status=1" onClick="return confirm('Are you sure you want to activate the account?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Activate"><button class="btn btn-success btn-xs"><i class="fas fa-check"></i></button></a>
                                          <?php }else{?>
                                            <button class="btn btn-transparent btn-xs tooltips btn-warning btn-xs" tooltip-placement="top" tooltip="New Employee"><i>new</i></button>
                                            <?php }?>
                                        </td>     
                                        <td>
                                          <?php if($positionid==1){?>
                                            <a href="employees.php?&id=<?php echo $userid?>&upgrade=2" onClick="return confirm('Are you sure you want to change position to Employee?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Upgrade Employee"><button class="btn btn-danger btn-xs"><i class="fas fa-arrow-down"></i></button></a> </td>   
                                          <?php }else{?>
                                            <a href="employees.php?&id=<?php echo $userid?>&upgrade=1" onClick="return confirm('Are you sure you want to  change position to Admin?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Downgrade"><button class="btn btn-success btn-xs"><i class="fas fa-arrow-up"></i></button></a> </td>   
                                          <?php }?>
                                        </td>
                                        <td>
                                          <a href="employees.php?&id=<?php echo $userid?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Delete"><button class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button></a> 
                                        </td>   
                                        </tr>
                                  <?php  }
                              $cnt++;
                              } 
                            }?>  

                      </tbody>
                      <tfoot>
                          <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Phone No</th>
                          <th>Position</th>
                          <th>Car Sold</th>
                          <th>Amount($)</th>
                          <th>Action</th>
                          <th><i class= "fas fa-arrow-up text-success"></i><i class="fas fa-arrow-down text-danger"></i></th>
                          <th>Delete</th>
                          </tr>
                      </tfoot>
                  </table>
                </div>
            </div></div>
               
        </div>
       </div>
   </section>

       
   <?php include '../includes/pages/general/scrolltotop.php'; ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include '../includes/pages/general/footer.php'; ?>
  <?php include '../includes/pages/general/footer-script.php'; ?>
  <?php include '../includes/pages/general/table-script.php'; ?>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>  <!-- Page Custom Scripts -->
  <!-- Page Custom Scripts -->
<script>
function checkEmail() {

$("#loaderIcon").show();
  jQuery.ajax({
  url: "../includes/connections/check_availability.php",
  data:'email='+$("#email").val(),
  type: "POST",
  success:function(data){
  $("#email-availability-status").html(data);
  $("#loaderIcon").hide();
  },
  error:function ()
  {
  event.preventDefault();
  alert('error');
  }
});
}
function checkPhone() {

$("#loaderIcon").show();
  jQuery.ajax({
  url: "../includes/connections/check_availability.php",
  data:'phone='+$("#phone").val(),
  type: "POST",
  success:function(data){
  $("#phone-availability-status").html(data);
  $("#loaderIcon").hide();
  },
  error:function ()
  {
  event.preventDefault();
  alert('error');
  }
});
}

</script>