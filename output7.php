<?php require_once('inc/connection.php'); ?>
<?php
 
  //for boeing 737//
  $result_boeing737_1=mysqli_query($connection,"select * from details_of_boeing737");
  $array_boeing737=array();
  $wholeRevenue_boeing737=0;
  $Type_and_flight_schedule_id=array();
  while($record=mysqli_fetch_assoc($result_boeing737_1)){
	  $array_boeing737[]=$record;
	  
	  $result_of_types=mysqli_query($connection,"select Seat_Type from seat where Seat_Id='{$record['Seat_ID']}'");
	  $type=mysqli_fetch_assoc($result_of_types);
	  $e_or_b_or_plat="";
	  if($type['Seat_Type']=="Economy"){$e_or_b_or_plat="Economy_Price";}
	  if($type['Seat_Type']=="Business"){$e_or_b_or_plat="Business_Price";}
	  else{$e_or_b_or_plat="Platinum_Price";}
	 
	 $final_query="select {$e_or_b_or_plat} from price where Flight_Schedule_ID='{$record['Flight_Schedule_ID']}'";
	 $final_result=mysqli_query($connection,$final_query);
	 //$price1=mysqli_fetch_assoc($final_result);
	 //print_r ($price1);
	 $price=mysqli_fetch_assoc($final_result)[$e_or_b_or_plat];
	 //echo $price;
	 $wholeRevenue_boeing737=$wholeRevenue_boeing737+$price;
	 
	 
	  
  }
  
  
  //for boeing 757//
  
  $result_boeing757_1=mysqli_query($connection,"select * from details_of_boeing757");
  $array_boeing757=array();
  $wholeRevenue_boeing757=0;
  $Type_and_flight_schedule_id=array();
  while($record=mysqli_fetch_assoc($result_boeing757_1)){
	  $array_boeing757[]=$record;
	  
	  $result_of_types=mysqli_query($connection,"select Seat_Type from seat where Seat_Id='{$record['Seat_ID']}'");
	  $type=mysqli_fetch_assoc($result_of_types);
	  $e_or_b_or_plat="";
	  if($type['Seat_Type']=="Economy"){$e_or_b_or_plat="Economy_Price";}
	  if($type['Seat_Type']=="Business"){$e_or_b_or_plat="Business_Price";}
	  else{$e_or_b_or_plat="Platinum_Price";}
	 
	 $final_query="select {$e_or_b_or_plat} from price where Flight_Schedule_ID='{$record['Flight_Schedule_ID']}'";
	 $final_result=mysqli_query($connection,$final_query);
	 //$price1=mysqli_fetch_assoc($final_result);
	 //print_r ($price1);
	 $price=mysqli_fetch_assoc($final_result)[$e_or_b_or_plat];
	 //echo $price;
	 $wholeRevenue_boeing757=$wholeRevenue_boeing757+$price;
	 
	 
	  
  }
  
  
  //for Airbus A 380//
  
  
  $result_airbus_1=mysqli_query($connection,"select * from details_of_airbusa38");
  $array_airbus=array();
  $wholeRevenue_airbus=0;
  $Type_and_flight_schedule_id=array();
  while($record=mysqli_fetch_assoc($result_airbus_1)){
	  $array_airbus[]=$record;
	  
	  $result_of_types=mysqli_query($connection,"select Seat_Type from seat where Seat_Id='{$record['Seat_ID']}'");
	  $type=mysqli_fetch_assoc($result_of_types);
	  $e_or_b_or_plat="";
	  if($type['Seat_Type']=="Economy"){$e_or_b_or_plat="Economy_Price";}
	  if($type['Seat_Type']=="Business"){$e_or_b_or_plat="Business_Price";}
	  else{$e_or_b_or_plat="Platinum_Price";}
	 
	 $final_query="select {$e_or_b_or_plat} from price where Flight_Schedule_ID='{$record['Flight_Schedule_ID']}'";
	 $final_result=mysqli_query($connection,$final_query);
	 //$price1=mysqli_fetch_assoc($final_result);
	 //print_r ($price1);
	 $price=mysqli_fetch_assoc($final_result)[$e_or_b_or_plat];
	 //echo $price;
	 $wholeRevenue_airbus=$wholeRevenue_airbus+$price;
	 
	 
	  
  }
  /* echo $wholeRevenue_airbus;
  echo "<br>";
  echo $wholeRevenue_boeing737;echo "<br>";
  echo $wholeRevenue_boeing757;
   */
  



?>


<html>
<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4CAF50;
    color: white;
}
</style>

<body>
<table>
  
  <tr>
  <th>Boeing 737</th>
  <th>Boeing 757</th>
  <th>Airbus A 380</th>
  </tr>
  
  <?php
       
	  echo "<tr>
	          <td>
			  {$wholeRevenue_boeing737}
	          </td>
	          <td>
			  {$wholeRevenue_boeing757}
			  </td>
			  <td>
			  {$wholeRevenue_airbus}
			  </td>
	  
	  
	       </tr>";
	  
	  
  
  ?>
 </table>



</body>
</html>  












