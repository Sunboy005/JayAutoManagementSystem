<?php
session_start();
$pagename="Sales Record";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/pages/general/head-top.php";

//Delete a Sales Record
if(isset($_GET['del'])){
    $query=mysqli_query($conn,"DELETE FROM  vehiclesales WHERE id = '".$_GET['id']."'");
    if($query){
      $_SESSION['alert'] = "successs";
      $_SESSION['alertmessage'] = "Sales record deleted Successfully";
      header("Location:storerecord.php");
    }else{
      $_SESSION['alert'] = "danger";
      $_SESSION['alertmessage'] = "Sales record failed to delete";
    }
  }
//Add sales record process
if(isset($_POST['addsalesrecord'])){
    $vehiclesold=$_POST['vehiclestore'];
    $squantity=$_POST['quantitysold'];
    $chasisno=$_POST['chasisno'];
    $unitsellingprice=$_POST['unitsellingprice'];
    $totalamount= $unitsellingprice*$squantity;
    $date=date('Y-m-d H:i:s');
    $query="SELECT * FROM vehiclestore WHERE id='$vehiclesold'";
    $result3 = mysqli_query($conn, $query);
    while($row3 = mysqli_fetch_array($result3)){
      $instorequantity=$row3['quantity'];
      $instoreunitcost=$row3['unit_buying_price'];
      $repairexpense=$row3['repair_expenses'];
    }
    $remain_quantity=$instorequantity-$squantity;
    if($remain_quantity<0){ 
      $_SESSION['alerticon'] = "danger";
      $_SESSION['alert'] = "You cannot sell more than what is in the store";
      header("Location: salesrecord.php");
     }else if(($instoreunitcost + $repairexpense) >= $unitsellingprice){ 
      $_SESSION['alerticon'] = "danger";
      $_SESSION['alert'] = "You cannot sell a unit less than the unit buying price";
     // header("Location: salesrecord.php");
     }else{  
    //Set the foreign key checks to 0
    $fk_set=mysqli_query($conn,"SET FOREIGN_KEY_CHECKS=0;");
    //Insert the sales details
    $sqlqq="INSERT INTO vehiclesales (vehiclestore_id, quantity,chasis_no,unit_selling_price, sold_by, date_created) VALUES ('$vehiclesold','$squantity','$chasisno','$unitsellingprice','$myid','$date')";
    //update store record
    $sql1="UPDATE vehiclestore SET quantity='$remain_quantity' WHERE id='$vehiclesold'";
  
    //check if the query is successful
    if ((mysqli_query($conn,$sqlqq)) && (mysqli_query($conn,$sql1)))
    {
      $_SESSION['alerticon'] = "success";
      $_SESSION['alert'] = "Sales record added to store successfully";
      //header("Location: salesrecord.php");
    }else{
      $_SESSION['alerticon'] = "error";
      $_SESSION['alert'] = "Sales record failed to add to store";
      die('Error: ' . mysqli_error($conn));
    }
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
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Sell A Vehicle</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                        <select name="vehiclestore" id="vehiclestore"  onChange="getVehicle(this.value);" class="form-control">
                        <option  disabled selected>Select Vehicle Model From Store</option>
                        <?php $sql ="SELECT * FROM vehiclestore WHERE quantity > 0";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){
                          $unitprice=$row['unit_buying_price'];
                          $repair=$row['repair_expenses'];
                          $min_price=$unitprice+$repair;
                        ?>
                        <option value="<?php echo $row['id']; ?>" >
                        <?php echo $row['model']; ?>
                        </option>
                        <?php } ?>  
                        </select>     
                            <div class="input-group-append">
                                <div class="input-group-text">
                                <span class="fas fa-store-alt text-primary"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                        <input type="text" name="vehicle" id="vehicle" class="form-control"  placeholder="Vehicle">
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-bus text-warning"></span>
                            </div>
                        </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="number" name="quantitysold" class="form-control" placeholder="Quantity to Sell" required="required" >
                            <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-sort-amount-up text-danger"></span>
                            </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="chasisno" class="form-control" placeholder="Chasis No (1234,12345,4567)" required="required" >
                            <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-registered text-success"></span>
                            </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="number" name="unitsellingprice" class="form-control"  placeholder="Unit Selling Price" required="required" >
                            <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-money-bill-wave-alt text-info"></span>
                            </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                            <button type="submit" name="addsalesrecord" class="btn btn-primary btn-block"><small><i class="fas fa-money-bills"></i></small><i class="fas fa-car"></i> &nbsp; Add Sales Record</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
      </div>
      <div class="col-sm-8">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Sold Vehicle Record</h3>
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
                  <th>Chasis No(s)</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $cnt=1;
                  $query2 = "SELECT * FROM vehiclesales";
                  $resultvs = mysqli_query($conn, $query2);
                  $rec_no=mysqli_num_rows($resultvs);
                  while($rowvs = mysqli_fetch_array($resultvs)){
                    $storeid=$rowvs['vehiclestore_id'];
                    $quantity=$rowvs['quantity'];
                    $unitsellingprice=$rowvs['unit_selling_price'];
                    $totalprice=$unitsellingprice*$quantity;
                    $chasisno=$rowvs['chasis_no'];
                    if ($rowvs==null){
                      echo '<tr>
                      <td>No vehicle in store to display</td>
                      </tr>';
                    }else{?>
                      <tr>
                        <?php echo '<td>'.$cnt.'</td>';?>
                        <?php
                        $sql = "SELECT* FROM vehiclestore WHERE id='$storeid'";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)){
                            $vehicleid=$row['vehicle_id'];
                            $model=$row['model'];

                          $sql1 = "SELECT* FROM vehicle WHERE id='$vehicleid'";
                          $result1 = mysqli_query($conn, $sql1);
                          while($row1 = mysqli_fetch_array($result1)){
                            $carmakeid=$row1['carmake_id'];
                            $categoryid=$row1['category_id'];
                          
                            $sql2 = "SELECT* FROM carmake WHERE id='$carmakeid'";
                            $result2 = mysqli_query($conn, $sql2);
                            $counter2= mysqli_num_rows($result2);
                            while($row2 = mysqli_fetch_array($result2)){  
                                $carmake= $row2['title'];
                            
                                $sql3 = "SELECT* FROM category WHERE id='$categoryid'";
                                $result3 = mysqli_query($conn, $sql3);
                                $counter3= mysqli_num_rows($result3);
                                while($row3 = mysqli_fetch_array($result3)){   
                                  $category=$row3['title'];
                                  ?>

                              <td><?php echo $model;?></td>
                              <td><?php echo $carmake; ?></td>
                              <td><?php echo $category;?></td>
                              <td><?php echo $chasisno ; ?></td>
                              <td><?php echo $quantity;?></td>
                              <td><?php echo $unitsellingprice; ?></td>
                              <td><?php echo $totalprice;?></td>
                              <?php  } ?>
                              </tr>
                              <?php  }}}
                              $cnt++;
                            }}
                            ?>

                          </tbody>
                          <tfoot>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Vehicle Maker</th>
                                <th>Category</th>
                                <th>Chasis No(s)</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
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
function getVehicle(val) {
  $.ajax({
    type: "POST",
    url: "../includes/connections/getdetails.php",
    data:'vehiclestore='+val,
    success: function(data){
    //alert(data);
    $('#vehicle').val(data);
    }
  });
}
</script>