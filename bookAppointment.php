<!DOCTYPE html>
<html>
<head>
	<title>Book Appointment</title>

</head>
<body>
<style>

form {
 border: 1px solid black;
 padding: 50px;
border-radius: 60px;
 background-color: #ffb6c1;
 width: 600px;
 margin: 0 auto;
}

 body{
	background-color: #FFD580;
	color: #000000;
	font-family: Times New Roman;
	text-align: center;
}

 input[type=submit] {
  background-color: #04AA6D;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
border-radius: 60px;
}

</style>

<?php 
session_start();
if(isset($_POST)){
 	if(isset($_POST["email"]) ){
		$_SESSION["email"] = $_POST["email"];
 	}
}

 $sql = "select * from vehicle where Customer_ID IN (select  ID from customer where email = '".$_SESSION["email"]."') ";
?>
	

<h1>Appointment Details</h1>
	
			<?php
			
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

	
			$result = mysqli_query($conn, $sql);

			$vin = "";
 			$customer_id = 0;
			if (mysqli_num_rows($result) > 0) {
				
				while($row = mysqli_fetch_assoc($result)) {
					$vin = $row['VIN'];
					$customer_id = $row['Customer_ID'];
				}
			} else {
				echo "0 results";
			}

			
			mysqli_close($conn);
			?>
		</tbody>
	</table>

<form action="bookAppointment.php" method="POST" >
	Enter Appointment Date: 
	<input type="date" name = "date" required> <br><br>

Choose Location:   <select name="location">  
<?php

 $sql = "select * from location ";
$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$id = $row['ID'];
		$address = $row['Address'];
	  	echo "<option value = '".$id."' selected> $address </option>  ";
	}
}

?>
      
</select> 
<br><br>


Choose One Service:  <select name="services_offered">  
<?php

 $sql = "select sp.SP_ID,  concat('VehicleType: ', so.VehicleType, ' | ', 'SVCType: ', so.SVCType, ' | ', 'Labor: ', so.Labor, ' | ', 'Price: ', so.Price ) AS vehicleDetails from services_offered so inner join service_part sp ON (sp.SVCType = so.SVCType) where (sp.VehicleType = so.VehicleType) ";
$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$id = $row['SP_ID'];
		$vehicleDetails = $row['vehicleDetails'];
		echo "<option value = '".$id."' selected> ".$vehicleDetails." </option>  ";
	}
}

?>
      
</select> 
<br><br>


<?php echo"Vehicle VIN : $vin"; ?>
<br><br>
<input type = "submit" value="Book An Appointment">
</form>
	
	

<?php
if(isset($_POST)){

  $email = $_SESSION["email"] ;
if(isset($_POST['date']) ){
	$date = $_POST['date'];
if(isset($_POST['location']) ){
	$location = $_POST['location'];
	 $_SESSION["services_offered"] = $_POST['services_offered'];
$sql = "INSERT INTO appointment (Date, Customer_ID, Location_ID, VIN) VALUES ('$date', '$customer_id', '$location', '$vin' )";
if (mysqli_query($conn, $sql)) {
   header("Location:payment.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


 $sql = "select ID from appointment where Date =  '$date' AND  Customer_ID =  $customer_id AND Location_ID = '$location' AND VIN = '$vin' ";
$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_assoc($result)) {
		$_SESSION["Appointment_ID"] = $row['ID'];
	}
}


}

}

}
?>




</body>
</html>