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

<h3>For a given time period (begin date and end date) compute revenue by location and service type.</h3>
<form action="report1.php" method="post">
	Select Start Date: <input type="date" name="StartDate"  style="width: 200px;" required> <br><br><br>
	Select End Date: <input type="date" name="end_date"  style="width: 200px;" required> <br><br><br>
	Enter Service Part ID: <input type="number" name = "SP_ID"  style="width: 200px;" required> <br><br><br>
	<input type="submit" value="Generate Report">
</form>


			<?php
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
if(isset($_POST)){



if(isset($_POST["StartDate"])){
	$StartDate = $_POST["StartDate"];
	$end_date = $_POST["end_date"];
	$SP_ID = $_POST["SP_ID"];
	$sql = "select sum(Amount) AS TotalAmount from invoice where (DatePaid between '$StartDate' AND '$end_date') AND SP_ID = $SP_ID ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					echo "<br><br>Total Amount: ". $row["TotalAmount"];
				}	
	}
}




}
			?>
	

	
	

</body>
</html>