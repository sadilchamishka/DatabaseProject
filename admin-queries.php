<?php require_once('inc/connection.php'); ?>
<?php
  
  
  #fetching flight schedule IDs
  $query1="select Flight_Schedule_ID from flight_schedule";
  $result_set=mysqli_query($connection,$query1);
  $flight_schedules=array();
  
  
  
?>
<html>

<style type="text/css">
 

.bg{
	background-image: url("images/airplane1.jpg");

    /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
button{
    background-color:#ccffcc;
	width:300px;
}
</style>
<body class="bg">
<head>
 <!--<link rel='stylesheet' href='http://codepen.io/assets/libs/fullpage/jquery-ui.css'>!-->

<!--<link rel="stylesheet" href="style1.css" media="screen" type="text/css" />!-->



</head>
<h1 style="color:blue">Welcome Admin</h1>
<script type="text/javascript">
   
   function show(id){
	   var ids=['f1','f2','f3','f4','f5','f6'];
	   
	  
	   if(document.getElementById(id).style.display=='none'){
	   document.getElementById(id).style.display='block';
       }
	   else{
		   document.getElementById(id).style.display='none';
	   }
	  for (index = 0, len = ids.length; index < len; ++index) {
		  if(ids[index]!=id){
          document.getElementById(ids[index]).style.display='none';
		  }
          }
   
   }
  //var a=document.getElementById("div1");
  //a.onclick(alert("hi"));
</script>
<button onclick="show('f1')"> Find Who travel in the given flight </button></a> 
<div class="form-card">
<form id="f1" action="output.php" method="POST" style="display:none;">     <!--this the first form !-->
  
   <p id="div1">select flight schedule id</p>
	<select name="flight">
	 <?php
	 while ($record=mysqli_fetch_assoc($result_set)){
	       $flight_schedules[]=$record;
		   echo $record[Flight_Schedule_Id];
		   echo "<option value='$record[Flight_Schedule_ID]'>$record[Flight_Schedule_ID]</option>";
	   }

	 ?>
	  
	</select>
	<select name="age">
	  <option value="above18">Above 18</option>
	  <option value="below18">Below 18</option>
	</select>
	<input type="date" name="Booking_Date" >Date</input>
  <input type="submit" value="search" class="form-submit"></input>
  <h2></h2>
  
</form>
</div>
     <!--this the second form !-->

<br><br>
<button onclick="show('f2')"> Find Number of Travellers for the given date range and to the given destination</button> 

<div class="form-card">

<form id="f2" action="output3.php" method="POST"  style="display:none;">  
   
  <p>select arrival airport 
  <select name="destination">
	 <?php
	 $query2="select Airport_Code from airport";
  $result_set=mysqli_query($connection,$query2);
  $airports=array();
	 while ($record=mysqli_fetch_assoc($result_set)){
	       $airports[]=$record;
		   echo $record[Airport_Code];
		   echo "<option value='$record[Airport_Code]'>$record[Airport_Code]</option>";
	   }

	 ?>
	  
	</select>
	<select name="age">
	  <option value="above18">Above 18</option>
	  <option value="below18">Below 18</option>
	</select>
  
  
  
  </p>
	
  <p>Date range : Start <input type="date" name="starting_date"></input> End <input type="date" name="end_date"></input> <input type="submit" value="search"></input></p>

  <h2></h2>
</form>	 
</div>
     <!--this the third form !-->
<br><br>
 
	 
<button onclick="show('f3')" > Find Number of Bookings for the given date range</button>
<div class="form-card">	 
<form id="f3" action="output4.php" method="POST" style="display:none;">     <!--this the first form !-->
   
 
  <p>Date range : Start <input type="date" name="starting_date"></input> End <input type="date" name="end_date"></input></p>
  <div>
  <p>Passenger Type 
  <select name="passenger_type" >
  
   <option value="Frequent" >Frequent</option>
   <option value="Gold" >Gold</option>
   </p>
  </select>
  </div>
  <input type="submit" value="search"></input>
  
</form>	 
</div>

     <!--this the fourth form !-->

<br><br>	 
	 
<button onclick="show('f4')"> Find Who travel in the next immediate flight </button></a> 
<div class="form-card">
<form id="f4" action="output5.php" method="POST" style="display:none;">     <!--this the first form !-->
  
   <p id="div1">select flight id no</p>
	<select name="Flight_ID">
	 <?php
	 $query3="select Flight_ID from flight";
     $result_set=mysqli_query($connection,$query3);
     $airports=array();
	 while ($record=mysqli_fetch_assoc($result_set)){
	       $flights[]=$record;
		   echo $record[Flight_ID];
		   echo "<option value='$record[Flight_ID]'>$record[Flight_ID]</option>";
	   }

	 ?>
	  
	</select>
	<input type="submit" value="search"></input>
</form>
</div>

<br><br>
<!--This is the fifth form!-->
<button onclick="show('f5')"> Find Details of the Root when given two airports</button> 

<div class="form-card">

<form id="f5" action="output6.php" method="POST"  style="display:none;">  
   
  <p>select origin airport</p>
  <select name="Origin">
	 <?php
	 $query2="select Airport_Code from airport";
  $result_set=mysqli_query($connection,$query2);
  $airports=array();
	 while ($record=mysqli_fetch_assoc($result_set)){
	       $airports[]=$record;
		   echo $record[Airport_Code];
		   echo "<option value='$record[Airport_Code]'>$record[Airport_Code]</option>";
	   }

	 ?>
	  
	</select>

  <p>select destination airport</p>
  <select name="Destination">
	 <?php
	 $query2="select Airport_Code from airport";
  $result_set=mysqli_query($connection,$query2);
  $airports=array();
	 while ($record=mysqli_fetch_assoc($result_set)){
	       $airports[]=$record;
		   echo $record[Airport_Code];
		   echo "<option value='$record[Airport_Code]'>$record[Airport_Code]</option>";
	   }

	 ?>
	  
	</select>
	
  <input type="submit" value="search"></input>

  <h2></h2>
</form>	 
</div>

<br><br>
<!--this is the sixth form!-->
<button onclick="show('f6')"> Find Total Revenue Generated By Each AirCraft</button> 

<div class="form-card">
<form id="f6" action="output7.php" method="POST"  style="display:none;">  
   
    <p></p>
	
  <input type="submit" value="search"></input>

  <h2></h2>
</form>	 


</div>




</body>
</html>