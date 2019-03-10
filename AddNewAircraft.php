<?php require_once('inc/connection.php'); ?>
<?php 

$PlaneID="";
$AircraftType="";
$Capacity="";
$_SESSION['PlaneID']=$_GET['PlaneID'];
$PlaneID=$_SESSION['PlaneID'];
if(isset($_POST['submit'])){
$errors=array();

	if(empty(trim($_POST['Capacity']))){
		$errors[]='$Capacity is required';

	}
    if(empty(trim($_POST['AircraftType']))){
		$errors[]='$AircraftType is required';

	}
	 

	if (empty($errors)){
    
    $AircraftType=$_POST['AircraftType'];
    $Capacity=(int)$_POST['Capacity'];
    $query3="start transaction";
    $query4="INSERT INTO Aircraft VALUES ('{$AircraftType}','{$Capacity}')";
    $query5="INSERT INTO Airplane VALUES ('{$PlaneID}','{$AircraftType}')";
    $query7="commit";
    $result3=mysqli_query($connection,$query3);
    $result4=mysqli_query($connection,$query4);
    $result5=mysqli_query($connection,$query5);
    if (!$result4 || !$result5) {
         $query6="Rollback";
         $result6=mysqli_query($connection,$query6);
        }
    $result7=mysqli_query($connection,$query7);
        
    header('Location:AddPlain.php?aircraft_added=true');
    
    
	
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
                            <input class="input--style-3" type="text" placeholder="AircraftType" name="AircraftType">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Capacity" name="Capacity">
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


