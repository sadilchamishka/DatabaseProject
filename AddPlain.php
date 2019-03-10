
<?php require_once('inc/connection.php'); ?>
<?php 

$PlaneID="";
$AircraftType="";
if(isset($_POST['submit'])){
    
$errors=array();

	if(empty(trim($_POST['PlaneID']))){
		$errors[]='$PlaneID is required';

	}
    if(empty(trim($_POST['AircraftType']))){
		$errors[]='$AircraftType is required';

	}
	 

	if (empty($errors)){
    $PlaneID=(int)$_POST['PlaneID'];
    $AircraftType=$_POST['AircraftType'];
    $query1="select * from Aircraft where Aircraft_Type='{$AircraftType}' limit 1";
    $result1=mysqli_query($connection,$query1);
    if (mysqli_num_rows($result1)==1){
        $query2="INSERT INTO Airplane VALUES ('{$PlaneID}','{$AircraftType}')";
        $result2=mysqli_query($connection,$query2);
    }
    else{
        header("Location:AddNewAircraft.php?PlaneID={$PlaneID}");
        
    }
	
	    
	  	
	  	//header('Location:index.php?user_added=true');
	 
 
	  

}


}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Au Register Forms by Colorlib</title>
	 
	
    <link href="css/addPassenger.css" rel="stylesheet" media="all">
</head>

<body  style="background: url(images/login.png);background-size:1550px 800px"
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
					<h2 class="title">Add Airplane</h2>
					<br></br>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="AircraftType" name="AircraftType">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="PlaneID" name="PlaneID">
                        </div>
                    
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="submit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>
