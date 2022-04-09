<?php
// connecting to database
$servername = "localhost";
$username = "root";
$password = "";
$database = "users";

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("unabable to connect due to error---->");
}

?>