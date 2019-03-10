<?php require_once('inc/connection.php'); ?>
<?php 

$Flight_Schedule_ID=$_GET['Flight_Schedule_ID'];

if(isset($_POST['submit'])){
$errors=array();

	if(empty(trim($_POST['Departure_Time']))){
		$errors[]='$Capacity is required';

	}
    if(empty(trim($_POST['Arrival_Time']))){
		$errors[]='$AircraftType is required';

	}
	 

	if (empty($errors)){
    
    $Departure_Time=$_POST['Departure_Time'];
    $Arrival_Time=$_POST['Arrival_Time'];
    $query4="UPDATE Flight_Schedule_ID set Departure_Time='{$Departure_Time}' Arrival_Time='{$Arrival_Time}' where Flight_Schedule_ID='{$Flight_Schedule_ID}'";
    $result4=mysqli_query($connection,$query4);
    
        
    header('Location:mainAdmin.php?Flight_Schedule_ID_Updated=true');
    
    
	
}


}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Au Register Forms by Colorlib</title>
	 
	
    <link href="css/addPassenger.css" rel="stylesheet" media="all">
</head>

<body  style="background: url(images/airplane1.jpg);background-size:1550px 800px"
>

<?php
       if (!empty($errors)){
       	echo "There were error in form";
       	echo "$errors";
       }
	  ?>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
					<h2 class="title">Add New Aircraft</h2>
					<br></br>
                    <form method="POST">
                        <div class="input-group">
                        Departure_Time<input class="input--style-3" type="time"  name="Departure_Time">
                        </div>
                        <div class="input-group">
                        Arrival_Time <input class="input--style-3" type="time"  name="Arrival_Time">
                        </div>
                    
                        
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name='submit' type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>


