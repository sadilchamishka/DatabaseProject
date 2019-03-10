<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php 
$resultlist='';
$From=$_GET['From'];
$To=$_GET['To'];
$Date=$_GET['Date'];
$userID=$_GET['userID'];
$query="select * from Price inner join (flight_schedule inner join (select Flight_ID from Flight where Origin='{$From}' and Destination='{$To}') as T using(Flight_ID)) using(Flight_Schedule_ID) where Date='{$Date}'";
$result_set=mysqli_query($connection,$query);
while ($row=mysqli_fetch_assoc($result_set)) {
	$arrivalTime=$row['Arrival_Time'];
	$departureTime=$row['Departure_Time'];
	$date=$row['Date'];
	$PlaneID=$row['Plane_ID'];
    $query1="select Aircraft_Type from airplane where Plane_ID='{$PlaneID}'";
    $result_set2=mysqli_query($connection,$query1);
    $AirplaneName=mysqli_fetch_assoc($result_set2);
	$Airplane=$row['Plane_ID'];
	$economyPrice=$row['Economy_Price'];
	$businessPrice=$row['Business_Price'];
	$platinumPrice=$row['Platinum_Price'];
	$resultlist.="<tr>";
	$resultlist.="<td width='20%'>{$date}</td>";
	$resultlist.="<td width='5%'>{$AirplaneName['Aircraft_Type']}</td>";
	$resultlist.="<td width='20%'>{$departureTime}</td>";
	$resultlist.="<td width='20%'>{$arrivalTime}</td>";
	$resultlist.="<td width='20%'>{$economyPrice}</td>";
	$resultlist.="<td width='20%'>{$businessPrice}</td>";
	$resultlist.="<td width='20%'>{$platinumPrice}</td>";
	$Flight_Schedule_ID=$row['Flight_Schedule_ID'];
	$resultlist.="<td width='20%'><a href='booking.php?Flight_Schedule_ID=$Flight_Schedule_ID&&userID=$userID'>select</a></td>";
	$resultlist.="</tr>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body  style="background: url(images/images1.jpg);background-size:1550px 800px"
>

  <div class="tbl-header">
    <table >
      
        <tr>
          <th width='1%'>Date</th>
		      <th width='10%'>Airplane</th>
          <th width='10%'>Departure Time</th>
          <th width='10%'>Arrival Time</th>
          <th width='10%'>Economy Price</th>
          <th width='10%'>Business Price</th>
          <th width='10%'>Platinum Price</th>
        </tr>
     </table> 
  <br></br>
  
  
      <table>
	  	<?php 
	  		echo $resultlist;
	  	?>        
     
		 </table>
  </div>
  </div>
</body>
</html>