<!DOCTYPE html>
<html>
<head>
	<title>Vehicle Appointment Status</title>

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

 $sql = "select * from appointment where Customer_ID IN (select  ID from customer where email = '".$_SESSION["email"]."')  AND ID IN (select Appointment_ID from invoice) ";
?>
	


	<h2 style="display: inline-block; "> Appointment Details </h2>
	<table style="margin-bottom: 50px !important; margin: 0 auto;">
		<thead>
			<tr>
				<th>Appointment ID</th>
				<th>VIN</th>
				<th>Date</th>
				<th>Status</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

	
			$result = mysqli_query($conn, $sql);

			
			if (mysqli_num_rows($result) > 0) {
				
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['ID'] . "</td>";
					echo "<td>" . $row['VIN'] . "</td>";
					echo "<td>" . $row['Date'] . "</td>";
					echo "<td>Completed</td>";
					
				}
			}else{
				echo '<tr><td colspan="4">No completed appointments</td></tr>';
			}



 $sql = "select * from appointment where Customer_ID IN (select  ID from customer where email = '".$_SESSION["email"]."')  AND ID NOT IN (select Appointment_ID from invoice) ";
?>
	


	

			<?php
			
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

	
			$result = mysqli_query($conn, $sql);

			
			if (mysqli_num_rows($result) > 0) {
 echo '  <h2 style="display: inline-block; "> Appointment Details </h2>11:48 27-04-2023
	<table style="margin-bottom: 50px !important; margin: 0 auto;">
		<thead>
			<tr>
				<th>Appointment ID</th>
				<th>VIN</th>
				<th>Date</th>
				<th>Status</th>
				
			</tr>
		</thead>
		<tbody> ';

				
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>" . $row['ID'] . "</td>";
					echo "<td>" . $row['VIN'] . "</td>";
					echo "<td>" . $row['Date'] . "</td>";
					echo "<td>Pending</td>";
					
				}
			}else{
				echo '<tr><td  colspan="4">No pending appointments</td></tr>';
			}
	


			mysqli_close($conn);
			?>
		</tbody>
	</table>


	<a href="add_vehicle.html" style="padding: 10px; style: display: inline-block; text-decoration: none;  background-color: #FFCCCB ; width: 100px; " >Add a new vehicle</a><br><br><br><br><br><br>


</body>
</html>