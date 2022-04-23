<?php require_once("dbconnect.php");

if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

		echo "<span class='warning-validity'><i class='fa fa-info'></i> &nbsp; Invalid email";
	}
	else {
		$result ="SELECT count(*) FROM users WHERE email=?";
		$stmt = $conn->prepare($result);
		$stmt->bind_param('s',$email);
		$stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        if($count>0)
        {
            echo "<span class='error-validity text-danger'><i class='fa fa-times'></i> &nbsp; Employee exist with this Email .</span>";
        }
    }
}
if(!empty($_POST["phone"])) {
	$phone= $_POST["phone"];
    $result ="SELECT count(*) FROM users WHERE phone=?";
    $stmt = $conn->prepare($result);
    $stmt->bind_param('s',$phone);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if($count>0)
    {
        echo "<span class='error-validity text-danger'><i class='fa fa-times'></i> &nbsp; Employee exist with this Phone Number .</span>";
    }
    
}
?>