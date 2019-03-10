<?php session_start();   ?>
<?php require_once('inc/connection.php'); ?>
<?php
$flightsheduleid=$_GET['Flight_Schedule_ID'];
$pessengerId=$_GET['userID'];
echo $pessengerId;
$list1="";
$Price="";

if(isset($_POST['submit'])){
    
    //$result7=mysqli_query($connection,$query7);
}
  if(isset($_POST['sadil'])){
      $today=date("Y-m-d");
      $Seat=(int)$_POST['sadil'];
    $query3="start transaction";
    $query7="commit";
    $query4="INSERT INTO Booking(Passenger_ID,Seat_ID,Flight_Schedule_ID,Booking_Date) VALUES ('{$pessengerId}','{$Seat}','{$flightsheduleid}','{$today}')";
    
    $result3=mysqli_query($connection,$query3);
    $result4=mysqli_query($connection,$query4);
    //$result5=mysqli_query($connection,$query5);
    if (!$result4) {
         $query6="Rollback";
         $result6=mysqli_query($connection,$query6);
         echo "The Seat not available now";
        }
    $result7=mysqli_query($connection,$query7);
    $query10="select Seat_Type from seat where Seat_ID='{$Seat}'";
    $query11="select * from Price where Flight_Schedule_ID='{$flightsheduleid}'";
    $result10=mysqli_query($connection,$query10);
    $result11=mysqli_query($connection,$query11);
    $row10=mysqli_fetch_assoc($result10);
    $row11=mysqli_fetch_assoc($result11);
    $SeatType = $row10['Seat_Type'];
    
    if ($SeatType=='Economy'){
        $Price=$row11['Economy_Price'];
    }
    elseif ($SeatType=='Business') {
        $Price=$row11['Business_Price'];
    }

    elseif ($SeatType=='Platinum') {
        $Price=$row11['Platinum_Price'];
    }
    
    //$result7=mysqli_query($connection,$query7);
    
/**$query11="select * from booking";
$result11=mysqli_query($connection,$query11);
echo mysqli_num_rows($result11);
**/


  }


    
    $planeidquery="select * from (SELECT * from seat where Plane_ID in (select Plane_ID FROM flight_schedule WHERE Flight_Schedule_ID='{$flightsheduleid}')) as D where Seat_ID not in(select Seat_ID from booking where Flight_Schedule_ID='{$flightsheduleid}') ";
    $reult=mysqli_query($connection,$planeidquery);
    while ($row=mysqli_fetch_assoc($reult)){
   $list1.="<li class='row row--1'>";
   $list1.="<ol class='seats' type='A'>";
   $list1.="<li class='seat'>";
   $Seat_ID=$row['Seat_ID'];
   $list1.="<input type='submit' name='sadil' value='$Seat_ID' id='sadil' />";
   $query12="select * from Seat where Seat_ID='{$Seat_ID}'";
   $result12=mysqli_query($connection,$query12);
   $row12=mysqli_fetch_assoc($result12);
   //$list1.="<input type='checkbox' id='1A' /> <a href='confirmBook.php?Seat_ID={$Seat_ID}&&Flight_Schedule_ID={$flightsheduleid}&&passengerID={$pessengerId}'>book</a> ";
   $list1.="<label for='1A'>";
   $SeatType=$row12['Seat_Type'];
   //echo $SeatType;
   $list1.="$SeatType";
   $list1.="</label> </li>";
   $list1.="</ol>     </li>";
   $list1.="";
   
       
           
           
       
       
       
       
   
    }
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>AirLines</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset_booking.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout_booking.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/style_booking.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/seat.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,700'>
    <link rel='stylesheet prefetch' href='http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/styleradio.css">
    <script type="text/javascript" src="js/jquery-1.4.2.js" ></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <script type="text/javascript" src="js/cufon-replace.js"></script>
    <script type="text/javascript" src="js/Myriad_Pro_italic_600.font.js"></script>
    <script type="text/javascript" src="js/Myriad_Pro_italic_400.font.js"></script>
    <script type="text/javascript" src="js/Myriad_Pro_400.font.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/ie6_script_other.js"></script>
    <script type="text/javascript" src="js/html5.js"></script>
    <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
    <!-- Latest compiled and minified CSS -->

    <![endif]-->
</head>
    <body id="page1">
        <!-- START PAGE SOURCE -->
        <div class="body1">
            <div class="main">
                <header>
                    <div class="wrapper">
                        <h1><a href="index.html" id="logo">AirLines</a><span id="slogan">International Travel</span></h1>
                        <div class="right">
                            <nav>
                                <ul id="top_nav">
                                    <li><a href="#"><img src="images/img1.gif" alt=""></a></li>
                                    <li><a href="#"><img src="images/img2.gif" alt=""></a></li>
                                    <li class="bg_none"><a href="#"><img src="images/img3.gif" alt=""></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="main">
            <div id="banner">
                <div class="text1"> COMFORT<span>Guaranteed</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                </div>
        </div>
        <div class="main">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div>
                    <section id="content">
                        <article class="col1">
                            <div class="pad_1">
                                <!--                seat booking show-->
                                <div class="plane">
                                    <div class="cockpit">
                                        <h1>Please select a seat</h1>
                                    </div>
                                    <div class="exit exit--front fuselage">
                                    </div>
                                    <ol class="cabin fuselage">
                                        
                                        
                                       <?php  echo $list1; ?>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </ol>
                                    <div class="exit exit--back fuselage">

                                    </div>
                                </div>
                                <!--                seat boking show end-->
                            </div>
                        </article>

                        
                              
                           <?php echo $Price?>
                           <br></br>
                            
                       

                    
                </div>

            </form>
        </div>
<!--        <div class="body2">-->
<!--            <div class="main">-->
<!--                <footer>-->
<!--                    <div class="footerlink">-->
<!--                        <p class="lf">Copyright &copy; 2010 <a href="#">Domain Name</a> - All Rights Reserved</p>-->
<!--                        <p class="rf">Design by <a href="http://www.templatemonster.com/">TemplateMonster</a></p>-->
<!--                        <div style="clear:both;"></div>-->
<!--                    </div>-->
<!--                </footer>-->
<!--            </div>-->
<!--        </div>-->
<!--        <script type="text/javascript"> Cufon.now(); </script>-->
<!--    <!-- END PAGE SOURCE -->-->
    </body>
</html>
<?php
    if(isset($_POST['bookconfirm'])){

        $class=$_POST['select'];
        $seatID=$_POST['seatID'];
        $date=date("Y-m-d");
        echo $pessengerId ;
        echo "<br>";
        echo $seatID;
        echo "<br>";
        echo $flightsheduleid;
        echo "<br>";
        $sql2="INSERT INTO booking VALUES (8,$pessengerId,'$seatID',$flightsheduleid,'$date')";
        $result3=mysqli_query($connection,$sql2);
        if($result3==false){
            echo "not inserted";
        }else{
            echo "inserted";
        }
    }else{
        echo 'not clicked';
    }



?>