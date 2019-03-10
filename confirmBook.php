
<?php require_once('inc/connection.php'); ?>
<?php 

$flightsheduleid=$_GET['Flight_Schedule_ID'];
$passengerID=$_GET['passengerID'];
$Seat_ID=$_GET['Seat_ID'];

if(isset($_POST['submit'])){
    
$errors=array();

	/*if(empty(trim($_POST['Parent']))){
		$errors[]='$PlaneID is required';

	}*/
    
	 

	if (empty($errors)){
    
    $LocationID=(int)$_POST['LocationID'];
    $query1="insert into Location values('{$LocationID}','{$Parent}','{$Child}')";
    $result1=mysqli_query($connection,$query1);
    
    header("Location:AddAirport.php?Parent={$Child}");
        

	
	    
	  	
	  	//header('Location:index.php?user_added=true');
	 
 
	  

}


}


if(isset($_POST['Finish'])){
    echo '
    <body>
    <form method="POST">
    <div class="input-group">
        <input class="input--style-3" type="text" placeholder="AirportName" name="AirportName">
    </div>
    <div class="input-group">
        <input class="input--style-3" type="text" placeholder="LocationID" name="LocationID1">
    </div>

    <div class="p-t-10">
        <button class="btn btn--pill btn--green" name="Add" type="submit">Add</button>
    </div>

    <br></br>
    <br></br>
    <br></br>
    <div class="p-t-10">
        <button class="btn btn--pill btn--green" name="Finish" type="submit">Finish</button>
    </div>
</form>
</body>
';
}

if(isset($_POST['Add'])){
    $AirportName=$_POST['AirportName'];
    echo "****************";
    echo $AirportName;
    $LocationID1=(int)$_POST['LocationID1'];
    $query1="insert into Airport values('{$Parent}','{$AirportName}','{$LocationID1}')";
    $result1=mysqli_query($connection,$query1);
    header('Location:mainAdmin.php?Airport_added=true');
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
					<h2 class="title">Add Airport</h2>
					<br></br>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Parent" name="Parent">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Child" name="Child">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="LocationID" name="LocationID">
                        </div>
                    
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="submit" type="submit">Submit</button>
                        </div>

                        <br></br>
                        <br></br>
                        
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="Finish" type="submit">Finish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>
