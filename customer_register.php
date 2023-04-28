
<?php

$db_host = "localhost: 3312";
$db_user = "root";
$db_pass = "Arokiya05$";
$db_Customer_name = "WoodyAutomative";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_Customer_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$phoneNo = mysqli_real_escape_string($conn, $_POST['phone']);
$email_Number = mysqli_real_escape_string($conn, $_POST['email']);
$cc_Number = mysqli_real_escape_string($conn, $_POST['cc']);
$Customer_name = mysqli_real_escape_string($conn, $_POST['name']);
$address = mysqli_real_escape_string($conn, $_POST['address']);


$sql = "INSERT INTO customer (name, Address, Phone, Email, CreditCard ) VALUES ( '$Customer_name', '$address', '$phoneNo', '$email_Number', '$cc_Number')";
if (mysqli_query($conn, $sql)) {
   header("Location:customer_login.html");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);

?>

