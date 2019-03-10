<?php require_once('inc/connection.php'); ?>
<?php
  
  
  if($_POST['Origin']==$_POST['Destination']){
	  echo "You given the same airport name <a href='admin-queries.php'>try again</a>";
	  die();
  }
  
  $query_data="select Flight_Schedule_ID,Plane_ID,Flight_ID,Date,Arrival_Time, Departure_Time from flight_schedule  where Flight_ID in (select Flight_ID from flight where Origin='{$_POST['Origin']}' and Destination='{$_POST['Destination']}') and (Date<curdate() or (Date=curdate() and Departure_Time<curtime()))";
  
  
  $result_set_data=mysqli_query($connection,$query_data);
  
   

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
  <tr> <th>Flight Schedule Id</th>
  <th>Plane Id</th>
  <th>Flight Id</th>
  <th>Date</th>
  <th>Arrival Time</th>
   <th>Departure Time</th>
   <th>Journey</th>
   <th>Passenger Count</th>

  
  
  
  </tr>
  
  
  <?php
       while($record=mysqli_fetch_assoc($result_set_data)){
		$fid=$record['Flight_Schedule_ID'];
		
		$query_temp="select count(passenger_id) from booking where Flight_Schedule_ID='{$fid}'";
		$record1=mysqli_fetch_assoc(mysqli_query($connection,$query_temp));
		//print_r($record1);
		echo "<tr><td>{$record['Flight_Schedule_ID']}</td>
		          <td>{$record['Plane_ID']}</td>
		          <td>{$record['Flight_ID']}</td>
		          <td>{$record['Date']}</td>
				  <td>{$record['Arrival_Time']}</td>
				  <td>{$record['Departure_Time']}</td><td>Success</td>
				  <td>{$record1['count(passenger_id)']}</td>
		</tr>";
		 
		
		
	 }
	 
	 // echo "<tr><td>Number of passengers </td></tr>";
	  
	 
  
  ?>
 </table>








</html>