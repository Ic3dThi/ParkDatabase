<?php
ob_start();
$timezone = date_default_timezone_set("America/Chicago");
session_start();
$servername = "q3vtafztappqbpzn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "wza2d7kuebod9xq1";
$password = "a8lcu7qdeqvpasc0";
$db = "oznxdf1zh5a96rnv";
$con = mysqli_connect($servername, $username, $password,$db);
if (!$con) {
   die("Connection failed: " . mysqli_connect_error());
}
?>