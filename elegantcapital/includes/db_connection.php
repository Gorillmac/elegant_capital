<?php
$servername = "localhost"; // Change if necessary
$username = "root"; // Default for XAMPP
$password = ""; // Default for XAMPP
$dbname = "elegantcapital"; // Make sure this is your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

