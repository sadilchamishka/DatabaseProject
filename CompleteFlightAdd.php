
<?php require_once('inc/connection.php'); ?>
<?php 

$Destination="";
$Origin="";


$_SESSION['Origin']=$_GET['Origin'];
$Origin=$_SESSION['Origin'];
$_SESSION['Destination']=$_GET['Destination'];
$Destination=$_SESSION['Destination'];

$query3="start transaction";
$query4="insert into Flight values(31,'{$Origin}','{$Destination}')";
$query5="insert into Flight values(32,'{$Destination}','{$Origin}')";

$query7="commit";
$result3=mysqli_query($connection,$query3);
$result4=mysqli_query($connection,$query4);
$result5=mysqli_query($connection,$query5);
if (!$result4 || !$result5) {
     $query6="Rollback";
     $result6=mysqli_query($connection,$query6);
    }
$result7=mysqli_query($connection,$query7);

header('Location:mainAdmin.php');


?>






