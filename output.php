<?php require_once('inc/connection.php'); ?>
<?php
   

 
 $flight_s_id=$_POST['flight'];
 $ageRange=$_POST['age'];
 $Booking_Date=$_POST['Booking_Date'];
 $agestring='';
 $select_query='';
 if ($ageRange=="below18"){
	 $select_query="select Name from passenger where Passenger_id in(select Passenger_id from booking where Flight_Schedule_ID='{$flight_s_id}' and Booking_Date='{$Booking_Date}') and Age<18";
	 }
 if ($ageRange=="above18"){
	 $select_query="select Name from passenger where Passenger_id in(select Passenger_id from booking where Flight_Schedule_ID='{$flight_s_id}' and Booking_Date='{$Booking_Date}') and Age>18";
 }
  
 
  $result_set=mysqli_query($connection,$select_query);
  $array=array();
  
  
 // print_r($record);
 
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
  <tr><th>Passenger Name</th></tr>
  
  <?php
    while($record=mysqli_fetch_assoc($result_set)){
	  $array[]=$record['Name'];
	  echo "<tr><td>{$record['Name']}</td></tr>";
	  
	  
  }
  if (sizeof($array)==0){echo "<tr><td>No any passengers</td></tr>";}
  
  ?>
 </table>

</html>

