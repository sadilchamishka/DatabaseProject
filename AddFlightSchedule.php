
<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php
$_SESSION['adminID']=$_GET['adminID'];
$_SESSION['date']=$_GET['date'];
$adminID=$_SESSION['adminID'];
$_SESSION['FlightID']=$_GET['FlightID'];
$FlightID=$_SESSION['FlightID'];
$date=$_SESSION['date'];

/**$query1="select * from admin where admin_id='{$adminID}' ";
$result_set1=mysqli_query($connection,$query1);
$admin=mysqli_fetch_assoc($result_set1);
**/
$query1="select * from Flight where Flight_ID='{$FlightID}' ";
$result_set1=mysqli_query($connection,$query1);
$admin=mysqli_fetch_assoc($result_set1);
$origin=$admin['Origin'];
$query2="select * from flight_schedule inner join flight using(Flight_ID) where Destination='{$origin}' and date='{$date}'";
$result_set2=mysqli_query($connection,$query2);
$resultlist='';
while ($admin1=mysqli_fetch_assoc($result_set2)){
  
//$sadil=$admin1['Flight_ID'];
$resultlist.="<tr>";
$Plane_ID=$admin1['Plane_ID'];
$query1="select * from airplane where Plane_ID='{$Plane_ID}'";
$result_set3=mysqli_query($connection,$query1);
$AirplaneName=mysqli_fetch_assoc($result_set3);
//$resultlist.="<td width='30%'>{$sadil}</td>";
$Arrival_Time=$admin1['Arrival_Time'];
$resultlist.="<td width='30%'>{$Arrival_Time}</td>";
$resultlist.="<td width='40%'>{$AirplaneName['Aircraft_Type']}</td>";
$resultlist.="<td><a href='ViewPlaneSchedule.php?Plane_ID=$Plane_ID&&Date=$date&&Arrival_Time=$Arrival_Time&&FlightID=$FlightID'>select </a></td>";
$resultlist.="</tr>";
}

$query3="select * from airplane where Plane_ID not in(select distinct Plane_ID from flight_schedule)";
$result_set3=mysqli_query($connection,$query3);

while ($plane1=mysqli_fetch_assoc($result_set3)){
  $resultlist.="<tr>";
  $resultlist.="<td> New Airplane </td>";
  $resultlist.="<td width='40%'>{$plane1['Aircraft_Type']}</td>";
  $p=$plane1['Plane_ID'];
  $resultlist.="<td><a href='ViewPlaneSchedule.php?Plane_ID=$p&&Date=$date&&FlightID=$FlightID'>select </a></td>";
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
<body>
<div class="table">
<br></br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <!--<th width='3%'>Flight_ID</th>-->
                <th width='40%'>Arrival Time</th>
                <th width='30%'>Airplane</th>
                
              </tr>
              </table>
              <br></br>
              <br></br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php echo $resultlist;?>
           </table>
           
          </div>
</body>
</html>