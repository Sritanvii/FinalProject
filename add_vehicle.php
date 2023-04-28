

<?php

$db_host = "localhost: 3312";
$db_user = "root";
$db_pass = "Arokiya05$";
$db_name = "woodyautomative";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$VehicleNumber_vin = $_POST['vin'];
$manufactured_year = $_POST['mfg'];
$color =  $_POST['color'];
$year = $_POST['year'];
$CarType =  $_POST['type'];

session_start();

			$sql = "select ID from customer where Email = '".$_SESSION["email"]."' ";
	
			$result = mysqli_query($conn, $sql);

			$customer_id = 0;
			if (mysqli_num_rows($result) > 0) {
				
				while($row = mysqli_fetch_assoc($result)) {
					$customer_id = $row["ID"];
				}
			}




$sql = "INSERT INTO vehicle (VIN, Mfg, Color, Year, type, Customer_ID) VALUES ('$VehicleNumber_vin', '$manufactured_year', '$color', '$year', '$CarType', '$customer_id' )";
if (mysqli_query($conn, $sql)) {
    echo "New vehicle added sucessfully!";
  header("Location:vehicle_manage.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);

?>