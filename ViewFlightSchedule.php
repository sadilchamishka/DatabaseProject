<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php 
$_SESSION['Flight_ID']=$_GET['Flight_ID'];
$Flight_ID=$_SESSION['Flight_ID'];
$userlist='';



$query="select * from Flight_Schedule where Flight_ID='{$Flight_ID}' ";
$result_set3=mysqli_query($connection,$query);
$resultlist='';
while ($FlightSchedule=mysqli_fetch_assoc($result_set3)){

$Flight_Schedule_ID=$FlightSchedule['Flight_Schedule_ID'];
$resultlist.="<tr>";
$PlaneID=$FlightSchedule['Plane_ID'];
$query1="select Aircraft_Type from airplane where Plane_ID='{$PlaneID}'";
$result_set2=mysqli_query($connection,$query1);
$AirplaneName=mysqli_fetch_assoc($result_set2);
$resultlist.="<td width='20%'>{$AirplaneName['Aircraft_Type']}</td>";
$resultlist.="<td width='30%'>{$FlightSchedule['Departure_Time']}</td>";
$resultlist.="<td width='30%'>{$FlightSchedule['Arrival_Time']}</td>";
$resultlist.="<td width='20%'>{$FlightSchedule['Date']}</td>";
$resultlist.="<td width='30%'><a href='EditFlightSchedule.php?Flight_Schedule_ID=$Flight_Schedule_ID&&Flight_ID=$Flight_ID'>edit </a></td>";
$resultlist.="</tr>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<<link rel="stylesheet" href="css/styleAdmin.css" type="text/css" media="all" />-->
    <title>Document</title>
</head>
<body   style="background: url(images/airplane1.jpg);background-size:1550px 800px"
>
<br></br>
<br></br>
<table >
      
      <tr>
        <th width='1%'>Airplne</th>
        <th width='10%'>Departure Time</th>
        <th width='10%'>Arrival Time</th>
        <th width='10%'>Date</th>
      </tr>
   </table> 
<br></br>


    <table>
        <?php 
            echo $resultlist;
        ?>        
   
       </table>

<br></br>
<div id="sidebar">
        
        
          
        
</body>
</html>