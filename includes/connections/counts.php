<?php 
//include
include('dbconnect.php');
if (!isset($_SESSION['user'])){
	header("Location: ../index.php");
	exit;
	
}else{
    $userId=$_SESSION['user'];
    #To get all news from the DB
	$result ="SELECT count(*) FROM vehiclesales";
	$stmt = $conn->prepare($result);
	$stmt->execute();
	$stmt->bind_result($allsoldcars);
	$stmt->fetch();
	$stmt->close();

    $result ="SELECT count(*) FROM vehiclesales WHERE sold_by='$userId'";
	$stmt = $conn->prepare($result);
	$stmt->execute();
	$stmt->bind_result($mysoldcars);
	$stmt->fetch();
	$stmt->close();

}
?>