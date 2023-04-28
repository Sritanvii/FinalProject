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

<h3>For a given time period (begin date and end date) compute the top 3 locations (in terms of total service revenue) in descending order.</h3>	
<form action="report2.php" method="post">
	Select Start Date: <input type="date" name="StartDate" required > <br><br><br>
	Select End Date: <input type="date" name="endDate" required ><br><br><br>
	<input type="submit" value="Generate Report">
</form>
<br><br>


			<?php
			$conn = mysqli_connect('localhost: 3312', 'root', 'Arokiya05$', 'woodyautomative');

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
if(isset($_POST)){

if(isset($_POST["StartDate"])){
	$sql = "select l.* from location l inner join appointment a ON (l.ID = a.Location_ID) where a.Date BETWEEN '".$_POST["StartDate"]."' AND '".$_POST["endDate"]."'  order by l.address DESC limit 3 ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			echo $row["Address"]."<br><br><br>";
		}
	}
	
}




}
			?>
	

	
	

</body>
</html>