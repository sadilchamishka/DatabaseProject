<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php

if (!isset($_SESSION['admin_id'])) {
    header('Location:index.php');
}
$adminID = $_SESSION['admin_id'];
?>

<?php

if(isset($_POST['submit'])){
 
   $errors=array();

   if(!isset($_POST['submit']) || strlen(trim($_POST['submit']))<1){
   	$errors[]='From is Missing/Invalid';
   }


   if(empty($errors)) {
    header("Location:AddFlightSchedule.php?adminID={$adminID}&&date={$_POST['date']}&&FlightID={$_POST['FlightID']}");
     
        
   } 
}
$query1= "select * from flight";
$result_set3=mysqli_query($connection,$query1);
$resultlist='';
while ($admin1=mysqli_fetch_assoc($result_set3)){
  

$sadil=$admin1['Flight_ID'];
$resultlist.="<tr>";
$resultlist.="<td>{$sadil}</td>";
$resultlist.="<td>{$admin1['Origin']}</td>";
$resultlist.="<td>{$admin1['Destination']}</td>";
$resultlist.="<td><a href='ViewFlightSchedule.php?Flight_ID=$sadil'>Click </a></td>";
$resultlist.="</tr>";

}
?>










<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Admin Page</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/styleAdmin.css" type="text/css" media="all" />
</head>
<body  style="background: url(images/login.png);background-size:1550px 800px"
>

<div id="header">
  <div class="shell">
    
    <div id="top">
      <h1><a href="#">Admin Page</a></h1>
      <div id="top-navigation"> Welcome <a href="#"><strong>Administrator</strong></a> <span>|</span> <a href="#">Help</a> <span>|</span> <a href="#">Profile Settings</a> <span>|</span> <a href="#">Log out</a> </div>
    </div>
    
    <div id="navigation">
      <ul>
        <li><a href="#" class="active"><span><b>Dashboard</b></span></a></li>
        <li><a href="AddPlain.php"><span><b >AddPlain</b></span></a></li>
        <li><a href="AddAirport.php"><span><b>AddAirport</b></span></a></li>
        <li><a href="AddFlight.php"><span><b>AddFlight</b></span></a></li>
        <li><a href="admin-queries.php"><span><b>View Reports</b></span></a></li>
      </ul>
    </div>
    
  </div>
</div>

<div id="container">
  <div class="shell">
    
    <br />
    
    <div id="main">
      <div class="cl">&nbsp;</div>
     
      <div id="content">
        <!-- Box -->
        <div class="box">
          <!-- Box Head -->
          <div class="box-head">
            <h2 class="left">Flights</h2>
            <div class="right">
              <label>search flights</label>
              <input type="text" class="field small-field" />
              <input type="submit" class="button" value="search" />
            </div>
          </div>
          
          <div class="table">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <th>Flight_ID</th>
                <th>from</th>
                <th>To</th>
                
              </tr>
              <?php echo $resultlist;?>
            </table>
           
          </div>
          <!-- Table -->
        </div>
        
          </form>
        </div>
        
      </div>
      
      <div id="sidebar">
        
        <div class="box">
          
          <div class="box-head">
            <h2>Flight Scheduling</h2>
          </div>
          
          <div class="box-content"> <a href="#" class="add-button"><span>Add new Flight Schedule</span></a>
            <div class="cl">&nbsp;</div>
            
            <form action="admin.php" method="post">
              
              
                <input  type="date" name='date'>
                <input type='text' name='FlightID' placeholder='FlightID'>
                <input type='submit' name='submit'>
              
              
      </form>
          </div>
        </div>
        <!-- End Box -->
      </div>
      <!-- End Sidebar -->
      <div class="cl">&nbsp;</div>
    </div>
    <!-- Main -->
  </div>
</div>

</body>
</html>

