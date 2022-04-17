<?php
session_start();
$pagename="Car Make";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/pages/general/head-top.php";
//Add Vehicle process
if(isset($_POST['addvehiclemaker'])){
  $name=$_POST['maker'];
  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="INSERT INTO carmake (title) VALUES ('$name')";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
    $_SESSION['alerticon']="success";
    $_SESSION['alert']="Vehicle Maker Added Successful";
  }else{
    $_SESSION['alerticon']="success";
    $_SESSION['alert']="Vehicle Maker Added Successful";
      echo "<script>swal('Failed!', 'Vehicle Maker Addition failed', 'danger');</script>";
      die('Error: ' . mysqli_error($conn));
  }
}

//Edit Vehicle Make process
if (isset($_POST['updatevehiclemake'])){
  $id=$_GET['id'];
  $name=$_POST['maker'];
  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="UPDATE carmake SET title='$name' WHERE id='$id'";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
      echo "<script>swal('Success!', 'Vehicle Maker Updated Successful', 'success');</script>";
      header("Location:vehiclemake.php");
  }else{
      echo "<script>swal('Failed!', 'Vehicle Maker Update Failed', 'danger');</script>";
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
                <h3 class="card-title">Add Vehicle Maker</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">
                  <div class="input-group mb-3">
                    <input type="text" name="maker" class="form-control" placeholder="Vehicle Maker">
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
                      <button type="submit" name="addvehiclemaker" class="btn btn-primary btn-block"><small><i class="fas fa-plus"></i></small><i class="fas fa-car"></i> Add Vehicle Maker</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
            <?php 
          if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            $dn = mysqli_query($conn,'SELECT * from carmake WHERE id="'.$id.'"');
            while($row =mysqli_fetch_array($dn)) {
               $makename = $row['title'];
              }
            ?>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Edit <?php echo  $makename?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <form action="vehiclemake.php?id=<?php echo $id;?>" method="post">
                  <div class="input-group mb-3">
                    <input type="text" name="maker" class="form-control" value="<?php echo $makename;?>">
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
                      <button type="submit" name="updatevehiclemake" class="btn btn-primary btn-block"><small><i class="fas fa-plus"></i></small><i class="fas fa-car"></i> Update Vehicle Maker</button>
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
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $cnt=1;
                      $sql = "SELECT * FROM carmake";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                        $vehiclemakeid=$row['id'];                                                                                              
                        if ($row==null){
                      echo '<tr>
                              <td>No make to display</td>
                            </tr>';		            
                      }else{?>
                          <tr>                  
                              <?php echo '<td>'.$cnt.'</td>';?>
                              <td><?php echo $row['title']; ?></td>
                              <td><a href="vehiclemake.php?&id=<?php echo $vehiclemakeid?>"><button class="btn btn-success btn-xs  btn-xs tooltips" tooltip-placement="top" tooltip="Edit"><i class="fas fa-edit"></i></button></a></td>                                                                      
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
                          <th>Edit</th>
                        </tr>
                    </tfoot>
                </table>
              </div>
            </div>
        </div>
               
        </div>
       </div>
       <div class="modal fade" id="modal-addvehicle">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add a New Vehicle</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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
