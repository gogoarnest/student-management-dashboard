<?php
$host = "YOUR_HOST";
$user = "YOUR_DB_USER";
$pass = "YOUR_DB_PASSWORD";
$db   = "YOUR_DB_NAME";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed");
}
?>
