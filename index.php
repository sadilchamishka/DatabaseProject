<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>

<?php 

if(isset($_POST['submit'])){
   $errors=array();

   if(!isset($_POST['email']) || strlen(trim($_POST['email']))<1){
   	$errors[]='User name is Missing/Invalid';
   }

if(!isset($_POST['password']) || strlen(trim($_POST['password']))<1){
   	$errors[]='password is Missing/Invalid';
   }

   if(empty($errors)) {
    
     $email=mysqli_real_escape_string($connection,$_POST['email']);
     $password=mysqli_real_escape_string($connection,$_POST['password']);
    $hashed_password=sha1($password);
     
       $query1="SELECT * FROM passenger
                 WHERE Email='{$email}'
                 AND Password='{$hashed_password}'
                 LIMIT 1  ";
$query2="SELECT * FROM admin
WHERE Email='{$email}'
AND Password='{$hashed_password}'
LIMIT 1  ";


     $result_set1=mysqli_query($connection,$query1);
     $result_set2=mysqli_query($connection,$query2);

     
     	if (mysqli_num_rows($result_set1)==1){
        $user=mysqli_fetch_assoc($result_set1);
        $_SESSION['user_id']=$user['Passenger_id']; 
        $_SESSION['first_name']=$user['Name'];
           header("Location:passenger.php?user_id={$_SESSION['user_id']}&&first_name={$_SESSION['first_name']}");

       }
      
       elseif(mysqli_num_rows($result_set2)==1){
         
        $admin=mysqli_fetch_assoc($result_set2);
        $_SESSION['admin_id']=$admin['admin_id']; 
        $_SESSION['first_name']=$admin['Name'];
           header("Location:mainAdmin.php?admin_id={$_SESSION['admin_id']}&&first_name={$_SESSION['first_name']}");

       }
     	


      else{
        $errors[]="Invalid Username/password";
      }


      


   } 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Log In - Airline Reservation System</title>
	<link rel="stylesheet" href ="css/main.css">
  <!--<link rel="stylesheet" type="text/css" href="css/index.css">-->
</head>
<body 
style="background: url(images/login.png);background-size:1550px 800px"

   >
	<div class="login">
    
<form action="index.php" method="post">
	
	<fieldset>
		<legend><h1>Log In</h1></legend>

		<?php 
           if(isset($errors) && !empty($errors)){

           	echo '<p class="error"> Invalid UserName / Password</p> ';
           }
		 ?>

       <p> 
         <label for="">Username:</label>
         <input type="text" name="email" id="" placeholder="Email Address">
       </p>

<p> 
         <label for="">Password:</label>
         <input type="password" name="password" id="" placeholder="Password">
       </p>
<p> 
         
         <input type="submit" name="submit" value="login"> 
       </p>
<p>
  <div class='signup'>
    
     <a  href="addPassenger.php"><font color="black">SignUp</font></a>
  </div>
  <br></br>
  <button style="height:50px;width:60px;color:green" id="guestlogin"><a href="guestlogin.php">Guest Login</a></button>
</p>

	</fieldset>
</form>
		<div>
</body>
</html>
<?php mysqli_close($connection); ?> 