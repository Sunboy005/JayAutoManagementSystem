<?php
session_start();
$pagename="Dashboard";
include "../includes/connections/dbconnect.php";
include "../includes/connections/userdetails.php";
include "../includes/connections/data.php";
include "../includes/pages/general/head-top.php";

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
            <h5 class="mb-2">Info Charts</h5>
            <div class="row">
                <!-- Bar chart -->
                <div class="col-md-6">
                    <?php include '../includes/pages/charts/barchart.php';?>
                </div>
                <!-- /.col -->
                <!-- Donut chart -->
                <div class="col-md-6">
                <?php include '../includes/pages/charts/donutchart.php';?>
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->

                <h5 class="mb-2">Info Box</h5>
                <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-info"><small><i class="fa fa-car"></i></small><i class="fa fa-car"></i><small><i class="fa fa-car"></i></small></span>

                    <div class="info-box-content">
                        <span class="info-box-text">All Total Cars </span>
                        <span class="info-box-number"><?php echo $carsinstore + $totalsoldcars; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-success"><small><i class="fa fa-car"></i></small><i class="far fa-flag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">In-Store Cars</span>
                        <span class="info-box-number"><?php echo 0 + $carsinstore; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-warning"><small><i class="fa fa-car  text-white"></i></small><i class="fa fa-money-bill"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sold Cars</span>
                        <span class="info-box-number"><?php echo 0 + $totalsoldcars; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fa fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Employees</span>
                        <span class="info-box-number"><?php echo $allemployees; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
                              <!-- =========================================================== -->

            <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                <span class="info-box-icon"><i class="far fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">My Sales</span>
                      <span class="info-box-number"><?php echo $mysales?></span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-success">
                <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">My No of cars sold</span>
                    <span class="info-box-number"><?php echo $mytotalcarssold?></span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-warning">
                <span class="info-box-icon"><i class="far fa-store-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Max Cars Sold by an Employee</span>
                    <span class="info-box-number"><?php echo $maxcarssold?></span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-12">
                <div class="info-box bg-gradient-danger">
                <span class="info-box-icon"><i class="fas fa-comments"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Max Money Made by an Employee</span>
                    <span class="info-box-number"><?php echo $maxmoneymade?></span>
                </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
            
        </div>
   </section>
    <!-- /.content -->

   <?php include '../includes/pages/general/scrolltotop.php'; ?>
  </div>
  <!-- /.content-wrapper -->
  <?php include '../includes/pages/general/footer.php'; ?>
  <?php include '../includes/pages/general/footer-script.php'; ?>
  <!-- Page Custom Scripts -->
  <!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Page specific script -->
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    <?php
    $name=array();
    $squantity=array();
    $bquantity=array();
    
    $sql = "SELECT * FROM vehiclestore";
    $result=mysqli_query($conn,$sql);
    while($row =mysqli_fetch_array($result)) {
      $bid=$row['id'];
      $vh=$row['vehicle_id'];
      $bquantity[]=$row['quantity'];
      $sqlh = "SELECT SUM(quantity) as quant, vehiclestore_id FROM vehiclesales WHERE vehiclestore_id='$bid'";
      $resulth=mysqli_query($conn,$sqlh);
      while($rowh =mysqli_fetch_array($resulth)) {
        $squantity[]=$rowh['quant'];  
        $sql1 = "SELECT * FROM vehicle WHERE id='".$vh."'";
        $result1=mysqli_query($conn,$sql1);
        while($row1 =mysqli_fetch_array($result1)) {
          $name[]=$row1['name'];
      }
    }
  }

     ?>
     var areaChartData = {
       labels  : <?php echo json_encode($name);?>,
       datasets: [
         {
           label               : 'Vehicle Bought',
           backgroundColor     : 'rgba(60,141,188,0.9)',
           borderColor         : 'rgba(60,141,188,0.8)',
           pointRadius          : false,
           pointColor          : '#3b8bba',
           pointStrokeColor    : 'rgba(60,141,188,1)',
           pointHighlightFill  : '#fff',
           pointHighlightStroke: 'rgba(60,141,188,1)',
           data                : <?php echo json_encode($bquantity);?>
         },
         {
           label               : 'Vehicle Sold',
           backgroundColor     : 'rgba(210, 214, 222, 1)',
           borderColor         : 'rgba(210, 214, 222, 1)',
           pointRadius         : false,
           pointColor          : 'rgba(210, 214, 222, 1)',
           pointStrokeColor    : '#c1c7d1',
           pointHighlightFill  : '#fff',
           pointHighlightStroke: 'rgba(220,220,220,1)',
           data                : <?php echo json_encode($squantity);?>
         },
       ]
     }

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: <?php echo json_encode($name);?>,
      datasets: [
        {
          data: <?php echo json_encode($bquantity);?>,
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#01a65a', '#f36915', '#00c99f', '#5cddbc', '#d24dde'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
  })
</script>
</body>
</html>
