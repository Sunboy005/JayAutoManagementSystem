<?php 
include('../connections/pdoconfig.php');
include('../connections/dbconnect.php');

if(!empty($_POST["vehiclestore"])) 
{	
    $model=$_POST['vehiclestore'];
    $stmt = $DB_con->prepare("SELECT * FROM vehiclestore WHERE id = :model");
    $stmt->execute(array(':model' => $model));
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
     
            $vehicleid= $row['vehicle_id'];
            $sql ="SELECT * FROM vehicle WHERE id= '$vehicleid'";
            $result = mysqli_query($conn, $sql);
            while($row1 = mysqli_fetch_array($result)){       
                echo htmlentities($row1['name']); 
            };
    }
}


if(!empty($_POST["vehicle"])) 
{	
    $id=$_POST['vehicle'];
    $stmt = $DB_con->prepare("SELECT * FROM vehicle WHERE id = :id");
    $stmt->execute(array(':id' => $id));
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        $carmakeid= $row['carmake_id'];
        $sql ="SELECT * FROM carmake WHERE id= '$carmakeid'";
        $result = mysqli_query($conn, $sql);
        while($row2 = mysqli_fetch_array($result)){       
            echo htmlentities($row2['title']); 
        }
    }
}
?>
