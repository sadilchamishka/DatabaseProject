<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php 

$PlaneID="";
$AircraftType="";
$resultlist="";

    $query1="select distinct Origin from Flight";
    $result1=mysqli_query($connection,$query1);
    while ($Flight=mysqli_fetch_assoc($result1)){
        $resultlist.="<tr>";
        $Origin=$Flight['Origin'];
        $resultlist.="<td width='20%'>{$Origin}</td>";
        $resultlist.="<td width='30%'><a href='AddFlightDestination.php?Origin=$Origin'>To</a></td>";
        $resultlist.="</tr>";
        }
        
        

    
	  	
	  	//header('Location:index.php?user_added=true');
	 
 
	  







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background: url(images/photo1.jpg);background-size:1550px 800px"
>
<div class="table">
<br></br>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <th>Origin</th>
                
                
              </tr>
              <br></br>
              <?php echo $resultlist;?>
            </table>
           
          </div>
</body>
</html>



