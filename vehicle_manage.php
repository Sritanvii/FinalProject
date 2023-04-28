<!DOCTYPE html>
<html>
<head>
	<title>Manage Vehicle</title>

</head>
<body>
<style>
table, tr, td, th{
  border-collapse: collapse;
 border: 3px solid #90EE90;
 background-color: #ffb6c1;
}

 body{
	color: #000000;
	font-family: Times New Roman;
	text-align: center;
}
tr{
height: 70px;
}
td, th{
 width: 170px;
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
	


	<h2 style="display: inline-block; ">Vehicle Details</h2>
	<table style="margin-bottom: 50px !important; margin: 0 auto;">
		<thead>
			<tr>
				<th>VIN</th>
				<th>Mfg</th>
				<th>Color</th>
				<th>Year</th>
				<th>Type</th>
				<th>Make Appointment</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			// connect to the database
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			// check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

	
			$result = mysqli_query($conn, $sql);

			// check if any rows were returned
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['VIN'] . "</td>";
					echo "<td>" . $row['Mfg'] . "</td>";
					echo "<td>" . $row['Color'] . "</td>";
					echo "<td>" . $row['Year'] . "</td>";
					echo "<td>" . $row['Type'] . "</td>";
					echo "<td><a style = 'padding: 10px; background-color: #FFA500'  href= 'bookAppointment.php?VIN=".$row['VIN']."' >Book Appointment</a></td>";
					
				}
			} else {
				echo "<tr><td colspan = '6' > <p style='color: red; text-align: center;' >Currently this customer have no vehicle</p></td></tr>";
			}

			mysqli_close($conn);
			?>
		</tbody>
	</table>


	<a href="add_vehicle.html" style="padding: 10px; style: display: inline-block; text-decoration: none;  background-color: #FFCCCB ; width: 100px; " >Add a new vehicle</a><br><br><br><br><br><br>

	<a href="appointment_status.php" style="padding: 10px; style: display: inline-block; text-decoration: none;  background-color: #FFCCCB ; width: 100px; " >View Appointment Status</a><br>	

</body>
</html>