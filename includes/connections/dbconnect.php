<?php
$host = $_SERVER['HTTP_HOST'];

if($host=="localhost"){
	$server="localhost";
	$username="root";
	$password="";
	$database="jayautodb";
}else{
	$server="sql308.byethost14.com";
    $username="b14_31565096";
    $password="SubJect";
    $database="b14_31565096_jayautos_db";
}
	
    // this will avoid mysql_connect() deprecation error.
	error_reporting( ~E_DEPRECATED & ~E_NOTICE );
	// but I strongly suggest you to use PDO or MySQLi.
		
	$conn = mysqli_connect($server,$username,$password);
	$dbcon = mysqli_select_db($conn,$database);
	
	if ( !$conn ) {
		die("Connection failed : " . $mysqli->connect_error);
	}
    ?>