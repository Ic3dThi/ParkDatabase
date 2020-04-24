<?php 

$conn_error = "Could not connect";

// SQL connection credentials


$servername = "q3vtafztappqbpzn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "wza2d7kuebod9xq1";
$password = "a8lcu7qdeqvpasc0";
$db = "oznxdf1zh5a96rnv";

$mysqli = new mysqli($servername, $username, $password, $db);

if ($mysqli->connect_errno) {
    die("Connect failed: ". $mysqli->connect_errno);
}

?>