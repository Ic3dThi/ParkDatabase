<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>Ticket Page</title>
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
<h1 style="text-align:center; font-size: 40px; border-style: solid; border-color:#f26419;border-width: thick";>Tickets</h1>
<?php
  header('Access-Control-Allow-Origin: *');
    $rowSQL = mysqli_query($conn, "Select MAX(ticketID) AS max FROM ticket");
    $row = $rowSQL->fetch_array();
    $largestNumber = $row['max'];
  ?>
<form method="post">
<script id="ticketID">
      var large= <?php echo json_encode(++$largestNumber, JSON_HEX_TAG); ?>;
      document.write("TicketID: " + large);
</script> 
<div>
  <label>Ride ID:</label>
    <select name="RideID">
      <option value= '1'>1 Speed Train</option>
      <option value= '2'>2 Fun Cups</option>
      <option value= '3'>3 Tunnel of Infatuation</option>
      <option value= '4'>4 Iron Man</option>
    </select>
    </div>
<div>
<div>
    <label>Date: </label>
    <input type= "date" id = "purchaseDate" name= "purchaseDate"/>
</div>
<?php
    $drop = mysqli_query($conn, "select visitorID from visitor");
    ?>
    <html>
    <div>
    <label>Select visitorID: </label>
    <select name='visitorID'>
    <?php
    while($rowa = $drop->fetch_assoc())
    {
      unset($visitorID);
      $visitorID = $rowa['visitorID'];
      echo '<option value = '.$visitorID.'>'.$visitorID.'</option>';
    }
?>
    </select>
    </div>
    </html>

<p><tr><td><input type="submit" name="submit" value="Submit"/></td></tr></p>
</form>
<?php
$ride = $_POST["RideID"];
$date = $_POST["purchaseDate"];
$visitor = $_POST["visitorID"];
if(isset($_POST['submit']))
{
  $sql = "INSERT INTO ticket (ticketID, FKTicketRide, PurchaseDate, VisitorID) VALUES ('$largestNumber', '$ride','$date', '$visitor')";
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