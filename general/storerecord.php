<?php
session_start();
$pagename="Vehicle Store";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/pages/general/head-top.php";
//Delete a Vehicle
if(isset($_GET['del'])){
	$query=mysqli_query($conn,"DELETE FROM  vehiclestore WHERE id = '".$_GET['id']."'");
  if($query){
    $_SESSION['alert'] = "successs";
    $_SESSION['alertmessage'] = "Vehicle deleted Successfully";
    header("Location:storerecord.php");
  }else{
    $_SESSION['alert'] = "danger";
    $_SESSION['alertmessage'] = "vehicle failed to delete";
  } 		
}

//Add Vehicle process
if(isset($_POST['addvehicletostore'])){
  $vehicle=$_POST['vehicle'];
  $model=$_POST['model'];
  $quantity=$_POST['quantity'];
  $unitcost=$_POST['unitcost'];
  $repairexpenses=$_POST['totalrepaircost'];
  $date=date('Y-m-d H:i:s');

  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="INSERT INTO vehiclestore (vehicle_id, quantity,model,unit_buying_price,repair_expenses, date_created) VALUES ('$vehicle','$quantity','$model','$unitcost','$repairexpenses','$date')";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
    $_SESSION['alerticon'] = "success";
    $_SESSION['alert'] = "Vehicle added to store successfully";
      header("Location: storerecord.php");
  }else{
    $_SESSION['alerticon'] = "danger";
    $_SESSION['alert'] = "Vehicle failed to add to store";
      die('Error: ' . mysqli_error($conn));
  }
}

//Edit Vehicle Make process
if (isset($_POST['updatevehiclestore'])){
  $id=$_GET['id'];
  $vehicle=$_POST['vehicle'];
  $model=$_POST['model'];
  $quantity=$_POST['quantity'];
  $unitcost=$_POST['unitcost'];
  $repairexpenses=$_POST['totalrepaircost'];
  $date=date('Y-m-d H:i:s');
  //Set the foreign key checks to 0
  $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
  //Insert the user
  $sql="UPDATE vehiclestore SET vehicle_id='$vehicle', quantity='$quantity', model='$model', unit_buying_price='$unitcost', repair_expenses='$repairexpenses' WHERE id='$id'";
  //check if the query is successful
  if (mysqli_query($conn,$sql))
  {
    $_SESSION['alerticon'] = "success";
    $_SESSION['alert'] = "In-Store Vehicle Updated Successfully";
    header("Location: storerecord.php");
  }else{
    $_SESSION['alerticon'] = "danger";
    $_SESSION['alert'] = "In-Store Vehicle Failed to Update";
      die('Error: ' . mysqli_error($conn));
  }
}
?>
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
          <div class="col-sm-4">
            <?php 
          if(isset($_GET['id'])){
            if($myposition_id==1){
              $eid = intval($_GET['id']);
              $dn = mysqli_query($conn,'SELECT * from vehiclestore WHERE id="'.$eid.'"');
              while($row =mysqli_fetch_array($dn)) {               
                $vehicleid = $row['vehicle_id'];
                $model= $row['model'];
                $quantity= $row['quantity'];
                $unitcost= $row['unit_buying_price'];
                $repaircost= $row['repair_expenses'];
                $sql ="SELECT * FROM vehicle WHERE id= '$vehicleid'";
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($result)){
                   $vehiclename = $row['name'];
                }
              }
              ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title text-center">Edit <?php echo  $vehiclename?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="storerecord.php?id=<?php echo $eid;?>" method="post">                  
                  <div class="input-group mb-3">
                    <select name="vehicle" id="vehicle" onChange="getCarmake(this.value);" class="form-control">
                    <?php $sql1 ="SELECT * FROM vehicle WHERE id='$vehicleid'";
                      $result1 = mysqli_query($conn, $sql1);
                      while($row1 = mysqli_fetch_array($result1)){
                      ?>  
                   <option value="<?php echo $row1['id']; ?>" ><?php echo $row1['name']; ?></option>
                    <?php }?>
                      <?php $sql ="SELECT * FROM vehicle";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                      ?>
                      <option value="<?php echo $row['id']; ?>" >
                      <?php echo $row['name']; ?>
                      </option>
                      <?php } ?>  
                    </select>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-bus text-warning"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" name="model" class="form-control"  value="<?php echo $model; ?>"  required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car text-primary"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="quantity" class="form-control" value="<?php echo $quantity; ?>" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-sort-amount-up text-danger"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="unitcost" class="form-control" value="<?php echo $unitcost; ?>" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-money-bill-wave-alt text-success"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="totalrepaircost" class="form-control" value="<?php echo $repaircost; ?>" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-coins text-info"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                      <button type="submit" name="updatevehiclestore" class="btn btn-primary btn-block"><small><i class="fas fa-arrow-up"></i></small><i class="fas fa-car"></i> &nbsp;Update Vehicle in Store</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
            <?php }else{?>
                <h1 class="text-danger"><i class="fas fa-danger"></i>You are not permitted to edit the store</h1>
              <?php }
              }else{?>
              <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add Vehicle to Store</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="" method="post">                  
                  <div class="input-group mb-3">
                    <select name="vehicle" id="vehicle" onblur="getCarmake(this.value);" class="form-control">
                      <option  disabled selected>Select Vehicle</option>
                      <?php $sql ="SELECT * FROM vehicle";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                      ?>
                      <option value="<?php echo $row['id']; ?>" >
                      <?php echo $row['name']; ?>
                      </option>
                      <?php } ?>  
                    </select>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-bus text-warning"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" name="carmake" id="carmake"  class="form-control"  placeholder="Vehicle Make"  disabled>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car text-danger"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="text" name="model" class="form-control"  placeholder="Vehicle Model"  required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-car text-primary"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="quantity" class="form-control" placeholder="Quantity Bought" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-sort-amount-up text-danger text-danger"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="unitcost" class="form-control" placeholder="Unit Cost" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-money-bill-wave-alt text-success"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                  <input type="number" name="totalrepaircost" class="form-control" placeholder="Total Repair Cost" required="required" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-coins text-info"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                      <button type="submit" name="addvehicletostore" class="btn btn-primary btn-block"><small><i class="fas fa-plus"></i></small><i class="fas fa-car"></i> &nbsp; Add Vehicle to Store</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
            <?php }?>
        </div>
        <div class="col-sm-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Vehicle in store List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <th>S/N</th>
                      <th>Name</th>
                      <th>Vehicle Maker</th>
                      <th>Category</th>
                      <th>Model</th>
                      <th>Quantity</th>
                      <th>Unit Cost</th>
                      <th>Total Repair Cost</th>
                      <?php if($myposition_id==1){?>
                      <th>Edit</th>
                      <th>Delete</th>
                        <?php }?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $cnt=1;
                      $sql = "SELECT * FROM vehiclestore";
                      $result = mysqli_query($conn, $sql);
                      while($row = mysqli_fetch_array($result)){
                        $storeid=$row['id'];                                                
                        $quantity=$row['quantity'];                                                
                        $unitcost=$row['unit_buying_price'];                                                
                        $repaircost=$row['repair_expenses'];                                                
                        $vehicleid=$row['vehicle_id'];                                              
                        $model=$row['model'];                                                
                        if ($row==null){
                      echo '<tr>
                              <td>No vehicle in store to display</td>
                            </tr>';		            
                      }else{?>
                          <tr>                  
                              <?php echo '<td>'.$cnt.'</td>';?>
                              <?php 
                                  $sql1 = "SELECT* FROM vehicle WHERE id='$vehicleid'";
                                  $result1 = mysqli_query($conn, $sql1);
                                  while($row1 = mysqli_fetch_array($result1)){                                            
                                    $carmakeid=$row1['carmake_id'];                                                       
                                    $categoryid=$row1['category_id'];                      ?>  
                              <td><?php echo $row1['name'];?></td>
                              <?php  }?>                              
                              <?php
                                  $sql2 = "SELECT* FROM carmake WHERE id='$carmakeid'";
                                  $result2 = mysqli_query($conn, $sql2);
                                  $counter2= mysqli_num_rows($result2);
                                  while($row2 = mysqli_fetch_array($result2)){   ?>
                                    
                                    <td><?php echo $row2['title'];?></td>   
                                    <?php  }  
                                    $sql3 = "SELECT* FROM category WHERE id='$categoryid'";
                                  $result3 = mysqli_query($conn, $sql3);
                                  $counter3= mysqli_num_rows($result3);
                                  while($row3 = mysqli_fetch_array($result3)){   ?>
                                    
                                    <td><?php echo $row3['title'];?></td>   
                                    <td><?php echo $model; ?></td>
                                    <td><?php echo $quantity; ?></td>
                                    <td><?php echo $unitcost; ?></td>
                                    <td><?php echo $repaircost; ?></td>
                                    <?php  } 
                               if($myposition_id==1){?>  
                              <td><a href="storerecord.php?&id=<?php echo $storeid?>"><button class="btn btn-success btn-xs  btn-xs tooltips" tooltip-placement="top" tooltip="Edit"><i class="fas fa-edit"></i></button></a></td>                                                                       
                              <td><a href="storerecord.php?&id=<?php echo $storeid?>&del=delete" onClick="return confirm('Are you sure you want to delete?')"class="btn btn-transparent btn-xs tooltips" tooltip-placement="top" tooltip="Remove"><button class="btn btn-danger btn-xs"><i class="fas fa-trash"></i></button></a> </td>                                                                      
                              <?php } ?>
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
                          <th>Vehicle Maker</th>
                          <th>Category</th>
                          <th>Model</th>
                          <th>Quantity</th>
                          <th>Unit Cost</th>
                          <th>Total Repair Cost</th>
                          <?php if($myposition_id==1){?>
                          <th>Edit</th>
                          <th>Delete</th>
                          <?php }?>
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
  <?php include '../includes/pages/general/table-script.php'; ?>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>  <!-- Page Custom Scripts -->
  

<script>
function getCarmake(val) {
$.ajax({
type: "POST",
url: "../includes/connections/getdetails.php",
data:'vehicle='+val,
success: function(data){
//alert(data);
$('#carmake').val(data);
}
});
}
</script>
