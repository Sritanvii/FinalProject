<!DOCTYPE html>
<html>
<head>
	<title>Report</title>

</head>
<body>
<style>

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




	<h2>Generate Reports</h2>
<h3>For a given day and location, a report of the pending service appointments.</h3>
<form action="report.php" method="post">
	<input type="date" name="date"  style="width: 200px;"  required > <br><br><br>
<?php
	$sql = "select * from location ";
	$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');
	$result = mysqli_query($conn, $sql);
	echo '<select name = "location" style="width: 200px;" required >';
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$address = $row['Address'];
			$id = $row['ID'];
	  		echo "<option value = '".$id."' selected> $address </option>  ";
		}
	}
	echo '</select>';
?>
<br><br><br>	<input type="submit" value="Generate Report">
</form>
<br><br>	



			<?php
			
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
if(isset($_POST)){



if(isset($_POST["date"])){
	$location = $_POST["location"];
	$date = $_POST["date"];
			$sql = "select a.ID from Appointment a left join invoice i ON (i.Appointment_ID = a.ID) where (a.Date = '$date') AND (a.Location_ID = $location) AND a.ID NOT IN (select Appointment_ID from invoice)";
	


echo "<h3>List of Pending Appointments</h3>";

			$result = mysqli_query($conn, $sql);

			
			if (mysqli_num_rows($result) > 0) {
				
				while($row = mysqli_fetch_assoc($result)) {
					
					echo "Appointment ID: ". $row["ID"] . " is pending<br>";
				}
			} else {
				echo "No Rows Available";
			}

			
			mysqli_close($conn);
}

}
			?>
	

	
	

</body>
</html>