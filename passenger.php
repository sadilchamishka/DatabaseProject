<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php
if (!isset($_SESSION['user_id'])) {
    header('Location:index.php');
}
$userID = $_SESSION['user_id'];

?>

<?php 
  $user_list='';
if(isset($_POST['fromButton'])){
  $user_list='';
   $errors=array();

   if(!isset($_POST['From']) || strlen(trim($_POST['From']))<1){
   	$errors[]='From is Missing/Invalid';
   }


   if(empty($errors)) {
    
     $From=mysqli_real_escape_string($connection,$_POST['From']);
     $query1="SELECT * FROM location WHERE Parent='{$From}' ";


     $result_set1=mysqli_query($connection,$query1);

     $user_list .= "<select>";
     while ($user = mysqli_fetch_assoc($result_set1)) {
		
        $user_list .= "<option>{$user['Child']}</option>";
        
        }
        
    $user_list .= "</select>";
        
   } 
}


else if(isset($_POST['toButton'])){
  $user_list='';
   $errors=array();

   if(!isset($_POST['To']) || strlen(trim($_POST['To']))<1){
   	$errors[]='To is Missing/Invalid';
   }


   if(empty($errors)) {
    
     $From=mysqli_real_escape_string($connection,$_POST['To']);
     $query1="SELECT * FROM location WHERE Parent='{$From}'";
    $result_set1=mysqli_query($connection,$query1);

     $user_list .= "<select>";
     while ($user = mysqli_fetch_assoc($result_set1)) {
		
        $user_list .= "<option>{$user['Child']}</option>";
        
        }
        
    $user_list .= "</select>";
          } 
}


else if(isset($_POST['Select'])){
  $user_list='';
   $errors=array();

   if(!isset($_POST['From']) || strlen(trim($_POST['From']))<1 || !isset($_POST['To']) || strlen(trim($_POST['To']))<1 || !isset($_POST['Date']) || strlen(trim($_POST['Date']))<1){
   	$errors[]='From is Missing/Invalid';
   }


   if(empty($errors)) {
    
     $From=mysqli_real_escape_string($connection,$_POST['From']);
     $To=mysqli_real_escape_string($connection,$_POST['To']);
     $Date=mysqli_real_escape_string($connection,$_POST['Date']);
     $query1="SELECT Child FROM location WHERE Parent='{$From}' ";
     $query2="SELECT Child FROM location WHERE Parent='{$To}' ";
     $result_set1=mysqli_query($connection,$query1);
     $result_set2=mysqli_query($connection,$query2);
     if(mysqli_num_rows($result_set1)>0){
           echo 'Please Fill From';
     }
     if(mysqli_num_rows($result_set2)>0){
      echo 'Please Fill To';
}
 if((mysqli_num_rows($result_set1)+mysqli_num_rows($result_set2)==0)){
   
  header("Location:FlightSchedule.php?From={$From}&&To={$To}&&userID={$userID}&&Date={$Date}");
 }
    
        
   } 
}


?>













<!DOCTYPE html>
<html lang="en">
<head>
<title>AirLines</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

</head>
<body id="page1"  style="background: url(images/login.png);background-size:1550px 800px">
<div class="main">
  <!--header -->
  <header>
    <div class="wrapper">
      <h1><a href="index.html" id="logo">AirLines</a></h1>
      <span id="slogan">Fast, Frequent &amp; Safe Flights</span>
      <nav id="top_nav">
        <ul>
          <li><a href="index.html" class="nav1">Home</a></li>
          <li><a href="#" class="nav2">Sitemap</a></li>
          <li><a href="contacts.html" class="nav3">Contact</a></li>
        </ul>
      </nav>
    </div>
    <nav>
      <ul id="menu">
        <li id="menu_active"><a href="index.html"><span><span>About</span></span></a></li>
        <li><a href="offers.html"><span><span>Offers</span></span></a></li>
        <li><a href="book.html"><span><span>Book</span></span></a></li>
        <li><a href="services.html"><span><span>Services</span></span></a></li>
        <li><a href="safety.html"><span><span>Safety</span></span></a></li>
        <li class="end"><a href="contacts.html"><span><span>Contacts</span></span></a></li>
      </ul>
    </nav>
  </header>
  <!-- / header -->
  <!--content -->
  <section id="content">
    <div class="for_banners">
      <article class="col1">
        <div class="tabs">
          <div class="content">
            <div class="tab-content" id="Flight">
              <form id="form_1" action="#" method="post">
                <div>
                  <br></br>
                  <div class="row"> <span class="left">From</span>
                    <input type="text" class="input" name="From">
                    <button  name="fromButton">*</button>
                  </div>
                  <div class="row"> <span class="left">To</span>
                    <input type="text" class="input" name="To">
                    <button  name="toButton">*</button>
                    
                  </div>
                  <div class="wrapper">
                    <div class="col1">
                      
                      <div class="row"> <span class="left">Date</span>
                        <input type="date" class="input1" name="Date">
                      </div>
                    </div>
                   
                  </div>
                  
                  
                  <div class="wrapper"> <span class="right relative"><input type="submit" value="Select" name="Select" class="button1"></span>  </div>
                </div>
              </form>
            </div>
            <?php
                    
                    echo $user_list; 
                
                ?>
           
</body>
</html>