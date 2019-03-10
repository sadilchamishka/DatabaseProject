<?php require_once('inc/connection.php'); ?>
<?php
 
 
 $query="select count(Passenger_id) from passenger where Passenger_id in(select Passenger_id from booking where Booking_Date>='{$_POST['starting_date']}' and Booking_Date<='{$_POST['end_date']}') and Passenger_Type='{$_POST['passenger_type']}'";
 
 $num_of_passengers=  mysqli_fetch_assoc(mysqli_query($connection,$query))['count(Passenger_id)'];
 
 
 
 if ($_POST['starting_date']=="" or $_POST['end_date']==""){
	 echo "Please Give the date range correctly!  <a href='admin-queries.php'>try again</a>"; die();
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
  <tr><th>Results for Number of <?php echo $_POST['passenger_type']." type ";?>passengers travelling between <?php echo $_POST['starting_date']." and ". $_POST['end_date'];?></th></tr>
  
  <?php
       if ($num_of_passengers==0){echo "<tr><td>No any passengers</td></tr>";}
	  else{
	  echo "<tr><td>Number of passengers :{$num_of_passengers}</td></tr>";
	  
	  }
  
  ?>
 </table>




</html>