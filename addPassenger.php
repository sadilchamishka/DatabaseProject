<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php 

$first_name="";
$age="";
$email="";
$password="";
$hashed_password="";

if(isset($_POST['submit'])){
$errors=array();

	if(empty(trim($_POST['first_name']))){
		$errors[]='First Name is required';

	}
    if(empty(trim($_POST['age']))){
		$errors[]='Age is required';

	}
	if(empty(trim($_POST['email']))){
		$errors[]='email is required';
	}

	if(empty(trim($_POST['password']))){
		$errors[]='password is required';
	}
     

	if (empty($errors)){
       
    $first_name=$_POST['first_name'];
    $age=$_POST['age'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hashed_password=sha1($password);


	$query="INSERT INTO Passenger (Name,Age,Email,password,Passenger_Type,Number_Of_Times) VALUES ('{$first_name}','{$age}','{$email}','{$hashed_password}','Frequent',0)";
   
	$result=mysqli_query($connection,$query);
	
	header('Location:index.php?user_added=true');
	 
 mysqli_close($connection); 
	  

}


}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    
    <title>Au Register Forms by Colorlib</title>
	 
	
    <link href="css/addPassenger.css" rel="stylesheet" media="all">
</head>

<body  style="background: url(images/login.png);background-size:1550px 800px"
>

<?php
       if (!empty($errors)){
       	echo "There were error in form";
       	echo "$errors";
       }
	  ?>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
					<h2 class="title">Registration Info</h2>
					<br></br>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Name" name="first_name">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Age" name="age">
                        </div>
                    
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>
