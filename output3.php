<?php require_once('inc/connection.php'); ?>
<?php
      
	  //echo $_POST['destination'];
  $query_if_airport_valid="select Location_ID from location where Child='{$_POST['destination']}'";
  $result_set_airports=mysqli_query($connection,$query_if_airport_valid);
  $record=mysqli_fetch_assoc($result_set_airports);
  if( sizeof($record)==0){echo "Airport given is not valid..please <a href='admin-queries.php'>try again</a>"; die();};
  
  
  $query="select count(Passenger_id) from booking where Flight_Schedule_ID in(select Flight_Schedule_ID from flight_schedule where Flight_ID in(select Flight_ID from flight where Destination='{$_POST['destination']}') and Date>='{$_POST['starting_date']}' and Date<='{$_POST['end_date']}')";
  
  $query1="select Age,Passenger_id from passenger where Passenger_id in (select Passenger_id from booking where Flight_Schedule_ID in(select Flight_Schedule_ID from flight_schedule where Flight_ID in(select Flight_ID from flight where Destination='{$_POST['destination']}') and Date>='{$_POST['starting_date']}' and Date<='{$_POST['end_date']}'))";
  $num_of_passengers= mysqli_fetch_assoc(mysqli_query($connection,$query))['count(Passenger_id)'];
 // echo $num_of_passengers;
  $below18counter=0;
  $above18counter=0;
  $tresult=mysqli_query($connection,$query1);
  while ($reco=mysqli_fetch_assoc($tresult)){
	  if ($reco['Age']<18){
		  $below18counter = $below18counter+1;
		  }
	  else{
		  $above18counter = $above18counter+1;
}
  }
  
 

?>
<html>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>

 <table>
  <tr><th>Results for Number of passengers travelling between <?php echo $_POST['starting_date']." and ". $_POST['end_date']." to ". $_POST['destination'] ;?></th></tr>
  
  <?php
       if ($num_of_passengers==0){echo "<tr><td>No any passengers</td></tr>";}
	  else{
		  if($_POST['age']=="below18"){
			  echo "<tr><td>Number of passengers :{$below18counter}</td></tr>";
	  
		  }else{
			  echo "<tr><td>Number of passengers :{$above18counter}</td></tr>";
	  
		  }
	  
	  }
  
  ?>
 </table>




</html>