<?php
 error_reporting(E_ALL);
    ini_set('display_errors', 'On');
require_once 'includes/connections/dbconnect.php';

session_start();

if(isset($_SESSION['user'])){

	session_destroy();

	header("Location: index.php");

}else{
    session_destroy();
    	header("Location: index.php");
}

?>
