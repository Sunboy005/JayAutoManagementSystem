<?php
//include
include('dbconnect.php');
#To get all news from the DB
$curdate=date('YY-m-d');
#To get all news from the DB

$result ="SELECT  SUM(quantity) FROM vehiclesales";
$stmt = $conn->prepare($result);
$stmt->execute();
$stmt->bind_result($totalsoldcars);
$stmt->fetch();
$stmt->close();

$result ="SELECT SUM(quantity) FROM vehiclesales WHERE sold_by='$myid'";
	$stmt = $conn->prepare($result);
	$stmt->execute();
	$stmt->bind_result($mysoldcars);
	$stmt->fetch();
	$stmt->close();


    $result ="SELECT SUM(quantity) FROM vehiclestore";
  	$stmt = $conn->prepare($result);
  	$stmt->execute();
  	$stmt->bind_result($carsinstore);
  	$stmt->fetch();
  	$stmt->close();

    $result ="SELECT count(*) FROM users WHERE position_id=2";
  	$stmt = $conn->prepare($result);
  	$stmt->execute();
  	$stmt->bind_result($allemployees);
  	$stmt->fetch();
  	$stmt->close();

    $result ="SELECT sum((quantity * unit_buying_price) + repair_expenses) FROM vehiclestore";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($totalcost);
    $stmt->fetch();
    $stmt->close();

    $result ="SELECT sum(quantity * unit_selling_price) FROM vehiclesales";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($totalsales);
    $stmt->fetch();
    $stmt->close();

    $result ="SELECT sum(quantity * unit_selling_price) FROM vehiclesales Where sold_by='$myid'";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($mysales);
    $stmt->fetch();
    $stmt->close();

    $result ="SELECT sum(quantity) FROM vehiclesales Where sold_by='$myid'";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($mytotalcarssold);
    $stmt->fetch();
    $stmt->close();

    $result ="SELECT max(quantity) FROM vehiclesales Group by sold_by Order by max(quantity) DESC LIMIT 1";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($maxcarssold);
    $stmt->fetch();
    $stmt->close();

    $result ="SELECT max(quantity* unit_selling_price) FROM vehiclesales Group by sold_by Order by max(quantity* unit_selling_price) DESC LIMIT 1";
    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($maxmoneymade);
    $stmt->fetch();
    $stmt->close();

    
  //   $result ="SELECT users.full_name AS 'username', 
  //   SUM(vehiclesales.quantity) AS 'totalsoldcars'
  //   FROM vehiclesales, user
  //   WHERE vehiclesales.sold_by=user.id
    

  // AND vehiclesales =
  // (
  //   SELECT MAX(P.pro_price)
  //     FROM item_mast P
  //     WHERE P.pro_com = C.com_id
  // );";

    $stmt = $conn->prepare($result);
    $stmt->execute();
    $stmt->bind_result($sellers);
    $stmt->fetch();
    $stmt->close();

    
    $profit=$totalsales - $totalcost; 
    if($totalsales==0){
        $percentageprofit=0;
    }else{
    $percentageprofit=($profit/$totalcost)*100;
    }
    //$maxseller=$sellers;


/*
    SELECT SUM(quantity) AS s, DATE_FORMAT(recdatetime, '%M') AS m
    FROM table_name
    GROUP BY DATE_FORMAT(recdatetime, '%Y-%m')




    */
?>
