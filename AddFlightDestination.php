
<?php require_once('inc/connection.php'); ?>
<?php 

$FlightID="";
$Origin="";
$resultlist="";
if(isset($_GET['Origin'])){
$_SESSION['Origin']=$_GET['Origin'];
$Origin=$_SESSION['Origin'];
}

$query2="select * from Airport where Airport_Code not in (select Origin from Flight)";
$result2=mysqli_query($connection,$query2);
while ($Destination=mysqli_fetch_assoc($result2)){
    $resultlist.="<tr>";
    $Destination1=$Destination['Airport_Code'];
    $resultlist.="<td width='20%'>{$Destination1}</td>";
    $resultlist.="<td width='30%'><a href='CompleteFlightAdd.php?Origin=$Origin&&Destination=$Destination1'>Select</a></td>";
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
<body  style="background: url(images/airplane1.jpg);background-size:1550px 800px"
>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <th>Destination</th>
                
                
              </tr>
              <?php echo $resultlist;?>
            </table>
</body>
</html>


