<?php
session_start();
$pagename="Car Make";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/pages/general/head-top.php";
//Delete a Vehicle
if(isset($_GET['del'])){
	$query=mysqli_query($conn,"DELETE FROM  vehicle WHERE id = '".$_GET['id']."'");
  if($query){
    echo "<script>swal('Success!', 'Vehicle deleted successfully', 'success');</script>";
    header("Location:vehicles.php");
  }else{
    $_SESSION['msg'] = "Query failed to delete";
    echo "<script>swal('Failed!', 'Vehicle failed to delete', 'danger');</script>";
  } 		
}

//Add Vehicle process
if(isset($_POST['addvehicle'])){
  $name=$_POST['name'];
  $category_id=$_POST['category'];
  $carmake_id=$_POST['make'];

  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="INSERT INTO vehicle (name, category_id, carmake_id) VALUES ('$name','$category_id','$carmake_id')";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
      echo "<script>swal('Success!', 'User registration successful', 'success');</script>";
      header("Location: vehicles.php");
  }else{
      echo "<script>swal('Failed!', 'User registration failed', 'danger');</script>";
      die('Error: ' . mysqli_error($conn));
  }
}

//Edit Vehicle Make process
if (isset($_POST['updatevehicle'])){
  $id=$_GET['id'];
  $name=$_POST['name'];
  $category_id=$_POST['category'];
  $carmake_id=$_POST['make'];
  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="UPDATE vehicle SET name='$name',category_id='$category_id',carmake_id='$carmake_id' WHERE id='$id'";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
      echo "<script>swal('Success!', 'Vehicle Updated Successful', 'success');</script>";
      header("Location:vehicles.php");
  }else{
      echo "<script>swal('Failed!', 'Vehicle Update Failed', 'danger');</script>";
      die('Error: ' . mysqli_error($conn));
  }
}
?>
 <!-- DataTables -->
<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<?php
  include "../includes/connections/counts.php";
?>

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
       <div class="row mr-4">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Vehicle</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                  <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Vehicle Name">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <select name="category" class="form-control">
                      <option  disabled selected>Vehicle Category</option>
                      <?php
                      $sql ="SELECT * FROM category";
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
                        <span class="fas fa-database"></span>
                      </div>
                    </div>
                  </div><div class="input-group mb-3">
                    <select name="make" class="form-control">
                      <option  disabled selected>Car Maker</option>
                      <?php
                      $sql ="SELECT * FROM carmake";
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
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <button type="submit" name="addvehicle" class="btn btn-primary btn-block"><small><i class="fas fa-plus"></i></small><i class="fas fa-car"></i> Add Vehicle</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
            <?php 
          if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            $dn = mysqli_query($conn,'SELECT * from vehicle WHERE id="'.$id.'"');
            while($row =mysqli_fetch_array($dn)) {
               $vehiclename = $row['name'];
              }
            ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Edit <?php echo  $vehiclename?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="vehicles.php?id=<?php echo $id;?>" method="post">
                  <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control"value="<?php echo $vehiclename?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <select name="category" class="form-control">
                      <option  disabled selected>Vehicle Category</option>
                      <?php
                      $sql ="SELECT * FROM category";
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
                        <span class="fas fa-database"></span>
                      </div>
                    </div>
                  </div><div class="input-group mb-3">
                    <select name="make" class="form-control">
                      <option  disabled selected>Car Maker</option>
                      <?php
                      $sql ="SELECT * FROM carmake";
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
                        <span class="fas fa-car"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-4">
                      
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <button type="submit" name="updatevehicle" class="btn btn-primary btn-block"><small><i class="fas fa-update"></i></small><i class="fas fa-car"></i> Update Vehicle</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
            <?php }?>
        </div>
        <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vehicle Maker List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Maker</th>                      
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $cnt=1;
                      $sql = "SELECT * FROM vehicle";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                        $vehicleid=$row['id'];                                                
                        $categoryid=$row['category_id'];                                                
                        $carmakeid=$row['carmake_id'];                                                
                        if ($row==null){
                      echo '<tr>
                              <td>No vehicle to display</td>
                            </tr>';		            
                      }else{?>
                          <tr>                  
                              <?php echo '<td>'.$cnt.'</td>';?>
                              <td><?php echo $row['name']; ?></td>
                              <?php 
                                  $sql1 = "SELECT* FROM category WHERE id='$categoryid'";
                                  $result1 = mysqli_query($conn, $sql1);
                                  $counter1= mysqli_num_rows($result1);
                                  while($row1 = mysqli_fetch_array($result1)){   ?>  
                              <td><?php echo $row1['title'];?></td>
                              <?php  }
                                  $sql2 = "SELECT* FROM carmake WHERE id='$carmakeid'";
                                  $result2 = mysqli_query($conn, $sql2);
                                  $counter2= mysqli_num_rows($result2);
                                  while($row2 = mysqli_fetch_array($result2)){   ?>  
                              <td><?php echo $row2['title'];?></td>   
                              <?php  } ?>  
                              <td><a href="vehicles.php?&id=<?php echo $vehicleid?>"><button class="btn btn-success btn-xs  btn-xs tooltips" tooltip-placement="top" tooltip="Edit"><i class="fas fa-edit"></i></button></a></td>                                                                       
                              <td><a href="vehicles.php?&id=<?php echo $vehicleid?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button></a> </td>                                                                      
                          </tr>
                          <?php  }
                      $cnt++;
                      } 
                    ?>  

                    </tbody>
                    <tfoot>
                        <tr>
                          <th>S/N</th>
                          <th>Name</th>
                          <th>Category</th>
                          <th>Maker</th>
                          <th>Edit</th>
                          <th>Delete</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>
               
        </div>
       </div>
   </section>

       
   <?php include '../includes/pages/general/scrolltotop.php'; ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include '../includes/pages/general/footer.php'; ?>
  <?php include '../includes/pages/general/footer-script.php'; ?>
  <!-- Page Custom Scripts -->

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
