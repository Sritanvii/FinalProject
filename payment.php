<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>

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
$service_offered ="";
if(isset($_SESSION)){
	if(isset($_SESSION["services_offered"])){
		$service_offered =  $_SESSION["services_offered"] ; 
	}
	$appointment_id = $_SESSION["Appointment_ID"] ;
}

?>


	

<h1>Payment Details</h1>
	
			<?php
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
?>
<form action="payment.php" method="POST" >
	Choose Payment Date: 
	<input type="date" name = "date" > <br><br>
	Enter Payment Amount: 
	<input type="number" name = "pay_amount" > <br><br>

</select> 
<br>
<input type = "submit" value="Make Payment">
</form>
	
	

<?php
if(isset($_POST)){

  
if(isset($_POST['date']) ){
	$date = $_POST['date'];
if(isset($_POST['pay_amount']) ){
	$pay_amount = $_POST['pay_amount'];
	 $_SESSION["services_offered"] = $_POST['services_offered'];
$sql = "INSERT INTO invoice (DatePaid, Amount,  Appointment_ID, SP_ID) VALUES ('$date', '$pay_amount', '$appointment_id', '$service_offered' )";

if (mysqli_query($conn, $sql)) {
    echo "Payment sucessfully!";
  header("Location:payment.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}



}

}

}
?>



</body>
</html>