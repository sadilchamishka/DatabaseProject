<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php

if(isset($_POST['login'])){
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    echo "-------------------";
    echo $email;

    $sql="INSERT INTO passenger (Name,Age,Email,Password,Passenger_Type,Number_of_Times) VALUES ('{$fullname}',10 ,'{$email}','p' ,'Guest',NULL )";
    $result=mysqli_query($connection,$sql);

    if (!$result==false){
        $sql1="select * from Passenger where Email='{$email}'";
        $result1=mysqli_query($connection,$sql1);
        $guest1=mysqli_fetch_assoc($result1);
        $_SESSION['user_id']=$guest1['Passenger_id']; 
        $_SESSION['first_name']=$guest1['Name'];
        echo $_SESSION['user_id'];
        
           header("Location:passenger.php?user_id={$_SESSION['user_id']}&&first_name={$_SESSION['first_name']}");
        
        //exit();
    }else{
        header('Location: guestlogin.php');
        //exit();
    }
}
?>