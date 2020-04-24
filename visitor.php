<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Visitor Page</title>
</head>
<?php
/*
$servername = "sql210.epizy.com";
$username = "epiz_25464757";
$password = "6yq7dOTIiKX3MgQ";
$db = "epiz_25464757_ParkDB";*/
$servername = "q3vtafztappqbpzn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "wza2d7kuebod9xq1";
$password = "a8lcu7qdeqvpasc0";
$db = "oznxdf1zh5a96rnv";
$conn = NEW MySQLi($servername, $username, $password,$db);
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
<h1 style="text-align:center; font-size: 40px; border-style: solid; border-color:#f26419;border-width: thick";>Maintenance Tickets</h1>
<?php
  header('Access-Control-Allow-Origin: *');
    $rowSQL = mysqli_query($conn, "Select MAX(visitorID) AS max FROM visitor");
    $row = $rowSQL->fetch_array();
    $largestNumber = $row['max'];
  ?>
<form method="post">
<script id="ticketID">
      var large= <?php echo json_encode(++$largestNumber, JSON_HEX_TAG); ?>;
      document.write("VisitorID: " + large);
</script> 
<div>
    <label>First Name</label>
    <input type = "text" id = "firstName" name= "firstName"  placeholder="Enter First Name"/>

</div>
<div>
    <label>Last Name</label>
    <input type = "text" id = "lastName" name= "lastName" placeholder="Enter Last Name"/>

</div>
<div>
    <label>Sign-Up Date</label>
    <input type= "date" id = "lastVisited" name= "lastVisited"/>
</div>
<p><tr><td><input type="submit" name="submit" value="Submit"/></td></tr></p>
</form>
<?php
$first = $_POST['firstName'];
$last = $_POST['lastName'];
$date = $_POST['lastVisited'];
if(isset($_POST['submit']))
{
  $sql = "INSERT INTO visitor (visitorID, LastName, FirstName, DateLastVisited) VALUES ('$largestNumber', '$last','$first', '$date')";
  if(!mysqli_query($conn,$sql))
  {
    echo mysqli_error($conn);
  }
  else
  {
    echo '<script>';
    echo 'alert("'.$sql.'\nInsert Complete")';
    echo '</script>';
  }
}
mysqli_close($conn);
?>

</html>