<?php
session_start();
$pagename="";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/pages/general/head-top.php";
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
          <div class="col-sm-12">
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
                    <th>Car Sold</th>
                    <th>Amount($)</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                                                    $cnt=1;
                                                $sql = "SELECT * FROM users WHERE position_id=2";
                                                $result = mysqli_query($conn, $sql);
                                                while($row = mysqli_fetch_array($result)){
                                                $userid=$row['id'];                                                
                                                if ($row==null){
                                                echo '<tr>
                                                        <td>No employee to display</td>
                                                      </tr>';		            
                                                }else{?>
                                                    <tr>                  
                                                        <?php echo '<td>'.$cnt.'</td>';?>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['phone']; ?></td>
                                                        <?php 
                                                            $sql = "SELECT SUM(quantity * unit_selling_price) AS sum_amount, SUM(quantity) AS total_quantity FROM vehiclesales WHERE sold_by ='$userid'";
                                                            $result = mysqli_query($conn, $sql);
                                                            $counter= mysqli_num_rows($result);
                                                            while($row = mysqli_fetch_array($result)){   ?>  
                                                        <td><?php echo $row['total_quantity'];?></td>
                                                        <td><?php echo $row['sum_amount'];?></td>                                               
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
                                              <th>Car Sold</th>
                                              <th>Amount($)</th>
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
