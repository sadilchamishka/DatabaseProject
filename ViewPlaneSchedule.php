<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php
$_SESSION['Plane_ID']=$_GET['Plane_ID'];
$_SESSION['Date']=$_GET['Date'];
$_SESSION['FlightID']=$_GET['FlightID'];
if (isset($_GET['Arrival_Time'])){
    $_SESSION['Arrival_Time']=$_GET['Arrival_Time'];
}
else{
    $_SESSION['Arrival_Time']=0;
}

$Plane_ID=$_SESSION['Plane_ID'];
$FlightID=$_SESSION['FlightID'];
$Date=$_SESSION['Date'];
$Arrival_Time=$_SESSION['Arrival_Time'];
$resultlist='';
if ($Arrival_Time!=0){


$query1="select * from flight_schedule where Plane_ID='{$Plane_ID}' and date='{$Date}' and Departure_Time>'{$Arrival_Time}' union select * from flight_schedule where Plane_ID='{$Plane_ID}' and date>'{$Date}' limit 1";

$result_set2=mysqli_query($connection,$query1);

while ($plane=mysqli_fetch_assoc($result_set2)){
  
$resultlist.="<tr>";
$resultlist.="<td>{$plane['Departure_Time']}</td>";
$resultlist.="<td>{$plane['Date']}</td>";
$resultlist.="</tr>";
}

}

if(isset($_POST['submit'])){
    $errors=array();
    
        if(empty(trim($_POST['DepartureTime1']))){
            $errors[]='DepartureTime1 is required';
    
        }
        if(empty(trim($_POST['ArrivalTime1']))){
            $errors[]='ArrivalTime1 is required';
    
        }
        if(empty(trim($_POST['DepartureTime2']))){
            $errors[]='email is required';
        }
    
        if(empty(trim($_POST['ArrivalTime2']))){
            $errors[]='ArrivalTime1 is required';
        }

        if(empty(trim($_POST['ScheduleID1']))){
            $errors[]='ScheduleID1 is required';
    
        }
        if(empty(trim($_POST['ScheduleID2']))){
            $errors[]='ScheduleID1 is required';
    
        }
         
    
        if (empty($errors)){
        $DepartureTime1=$_POST['DepartureTime1'];
        $ArrivalTime1=$_POST['ArrivalTime1'];
        $DepartureTime2=$_POST['DepartureTime2'];
        $ArrivalTime2=$_POST['ArrivalTime2'];
        $ScheduleID1=(int)$_POST['ScheduleID1'];
        $ScheduleID2=(int)$_POST['ScheduleID2'];
        $FlightID1=$FlightID;
        
        
        $query1="select * from Flight where Origin in (select Destination from Flight where Flight_ID='{$FlightID1}') and Destination in(select Origin from Flight where Flight_ID='{$FlightID1}')";
        $result_set4=mysqli_query($connection,$query1);
       
        $Result=mysqli_fetch_assoc($result_set4);
        $FlightID2=$Result['Flight_ID'];
    
        $query2="start transaction";
        $query3="insert into Flight_Schedule values('{$ScheduleID1}','{$Plane_ID}','{$FlightID1}','{$ArrivalTime1}','{$DepartureTime1}','{$Date}')";
        $query4="insert into Flight_Schedule values('{$ScheduleID2}','{$Plane_ID}','{$FlightID2}','{$ArrivalTime2}','{$DepartureTime2}','{$Date}')";
        
        $query5="commit";
        
        $result2=mysqli_query($connection,$query2);
        $result3=mysqli_query($connection,$query3);
        $result4=mysqli_query($connection,$query4);
        
        if (!$result3 || !$result4) {
            
            $query6="Rollback";
            $result6=mysqli_query($connection,$query6);
        }
        $result5=mysqli_query($connection,$query5);
        
        
           
              
              //header('Location:index.php?schedule_added=true');
         
     mysqli_close($connection); 
          
    
    }
    
    
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
                
                
                <th width='4%'>Departure Time</th>
                <th width='40%'>Date</th>
              </tr>
              </table>
              <br></br>
              <br></br>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php echo $resultlist;?>
           </table>
           
          </div>
<br></br>
    <form method="POST">
                        Origin to Destination
                        <div class="input-group">
                        DepartureTime<input class="input--style-3" palceholder='00:00:00' type="text"  name="DepartureTime1">
                        </div>
                        <div class="input-group">
                        ArrivalTime <input class="input--style-3" palceholder='00:00:00' type="text"  name="ArrivalTime1">
                        </div>
                    
                        <div class="input-group">
                        ScheduleID  <input class="input--style-3" type="text"  name="ScheduleID1">
                        </div>
                        <br></br>
                        Destination to Origin
                        <div class="input-group">
                        DepartureTime<input class="input--style-3" palceholder='00:00:00' type="text"  name="DepartureTime2">
                        </div>
                        <div class="input-group">
                        ArrivalTime <input class="input--style-3" type="text"  palceholder='00:00:00' name="ArrivalTime2">
                        </div>
                    
                        <div class="input-group">
                        ScheduleID  <input class="input--style-3" type="text"  name="ScheduleID2">
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" name='submit' type="submit">Submit</button>
                        </div>

                        
                        
                    </form>
</body>
</html>