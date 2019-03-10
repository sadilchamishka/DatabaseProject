<?php require_once('inc/connection.php'); ?>
<?php

 
 
 $query="select Name from passenger where Passenger_id in(select Passenger_id from booking where Flight_Schedule_ID in(select Flight_Schedule_ID from flight_schedule where Flight_ID={$_POST['Flight_ID']} and Date>curdate() or ( Date=curdate() and Departure_Time>=curtime()) )) and Age>18 ";
 $result_set=mysqli_query($connection,$query);
 
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


<body>
<table>
  <tr><th>Results for Passengers who travel in flight number :  <?php echo $_POST['Flight_ID']." ";?>in next immediate flight </th></tr>
  
  <?php
       
	   if($result_set==false){echo "wtf";}
      else{
         while($record=mysqli_fetch_assoc($result_set)){
		    
		      echo "<tr><td>{$record['Name']}</td></tr>";
	  
	      }
 
      }
	   
	   
	   
	   
	   
	   
  ?>
 </table>

</body>



</html>