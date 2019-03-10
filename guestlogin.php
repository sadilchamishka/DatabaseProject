<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php 

$first_name="";
$age="";
$email="";
$password="";

if(isset($_POST['submit'])){
$errors=array();

	if(empty(trim($_POST['email']))){
		$errors[]='email is required';
	}

	if(empty(trim($_POST['fullname']))){
		$errors[]='password is required';
	}
     

	if (empty($errors)){
       
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $query="INSERT INTO Passenger (Name,Age,Email,password,Passenger_Type,Number_Of_Times) VALUES ('{$first_name}',10,'{$email}','x','Guest',0)";
    $result=mysqli_query($connection,$query);
	$sql1="select * from Passenger where Email='{$email}'";
    $result1=mysqli_query($connection,$sql1);
    $guest1=mysqli_fetch_assoc($result1);
    $_SESSION['user_id']=$guest1['Passenger_id']; 
    $_SESSION['first_name']=$guest1['Name'];
        
    header("Location:passenger.php?user_id={$_SESSION['user_id']}&&first_name={$_SESSION['first_name']}");
        
	
	 
 mysqli_close($connection); 
	  

}


}


?>


<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Sign Up Form</title>
    <link rel="stylesheet" href="css/styleguest.css">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<form class="sign-up" action="guestloginprocess.php" method="post">
    <h1 class="sign-up-title">Login as a Guest</h1>
    <input type="text" name="fullname" class="sign-up-input" placeholder="Full Naeme" autofocus>
    <input type="email" name="email" class="sign-up-input" placeholder="Email">
    <input type="submit" name="login" value="Login" class="sign-up-button">
</form>

</body>
</html>
