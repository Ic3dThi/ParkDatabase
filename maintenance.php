<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Maintenance Tickets</title>
  <style>
  body
  {
    font-family: sans-serif;
  }
  
  ul {
    font-family: monospace;

  }
.left {
  padding-top: 50px;
  height: 20px;
  width: 135px;
  transform: translate(300%,0px);
}

.right {
  padding: 40px;
  position: absolute;
  right: 35%;
  transform: translate(50%, -65px);
}
#Description
{
  width: 200%;

  background: #D3D3D3
}
#Ticket
{
  position: absolute;
  right: 40%;
  transform: translate(110px, -23px);
}
input[name = "submit"]
{
  top: 99%;
  right: 50%;
  position: absolute;
}
input[type = "date"]
{
  transform: translate(0px, 10px);
}
select[name = "RideID"]
{
  height: 20px;
  width: 140px;
  text-align: center;
  transform: translate(0px, 10px);
}
select[name = "maintenanceSelect"]
{
  transform: translate(55px, 0px);
}
h1{
  text-align: center;
  
}
  </style>
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
//echo "Connected successfully";
include 'navbar.php';
?>

<body>
  <h1 style="text-align:center; font-size: 40px; border-style: solid; border-color:#f26419;border-width: thick";>Maintenance Tickets</h1>
  <p id="date"></p>
  <div id = "entire">
  <form method ="post"> 
  <?php
  header('Access-Control-Allow-Origin: *');
    $rowSQL = mysqli_query($conn, "Select MAX(maintenanceID) AS max FROM maintenancetickets");
    $row = $rowSQL->fetch_array();
    $largestNumber = $row['max'];
  ?>
    <div id="AddOrUpdate">
      <div class = "left">
        <label for="Add_Update_radio">Add or Update?</label>
      </div>
      <div class = "right">
        <input type="radio" onclick="javascript:addUpdateCheck();" name="Add_Update" id="addCheck" value = 1 checked>Add</input>
        <input type="radio" onclick="javascript:addUpdateCheck();" name="Add_Update" id="updateCheck" value = 0>Update</input>
      </div>
    </div>

    <div class = "left">
      <p class="Ticket" , name="TicketID">Ticket ID</p>
    </div>
    <?php
      $drop = mysqli_query($conn, "select maintenanceID from maintenancetickets");
      ?>
      <html>
      <div class = "right">
      <select name='maintenanceSelect'>
      <?php
      while($rowa = $drop->fetch_assoc())
      {
        unset($maintenanceID);
        $maintenanceID = $rowa['maintenanceID'];
        echo '<option value = '.$maintenanceID.'>'.$maintenanceID.'</option>';
      }
      ?>
      </select>
      </div>
      </html>
    <div id = "Ticket">
    <script id="ticketID">
      var large= <?php echo json_encode(++$largestNumber, JSON_HEX_TAG); ?>;
      document.write("Ticket number: " + large);
    </script> 
    </div>
    <div class = "left">
    <p class="Ride">Ride ID</p>
    </div>
    <div class = "right">
    <select name="RideID">
      <option value= '1'>1 Speed Train</option>
      <option value= '2'>2 Fun Cups</option>
      <option value= '3'>3 Tunnel of Infatuation</option>
      <option value= '4'>4 Iron Man</option>
    </select>
    </div>
    <div class = "left">
        <p class="Start">Start Date: </p>
    </div>
    <div class = "right">
        <input type="date" , id="StartDate" name = "StartDate"/>
    </div>
    <div class = "left">
        <p class="End">End Date: </p>
    </div>
    <div class = "right">
        <input type="date", id = "EndDate" name = "EndDate"/>
    </div>
    <!--
    <div class = "left">
        <label for="broken_radio">Is it currently broken?</label>
      </div>
    <div class = "right">
          <input type="radio" name="broken" id="brokenYesCheck" value = 1 checked>Yes</input>
          <input type="radio" name="broken" id="brokenNoCheck" value = 0>No</input>
    </div>
    -->
    <div id="WhyClosed">
      <p>
      <div class = "left">
        <label for="yes_no_radio">Closed Due to Rain?</label>
      </div>
      <script>
      function yesnoCheck() {
          if (document.getElementById('noCheck').checked) {
              document.getElementById('ifNo').style.visibility = 'visible';
          }
          else document.getElementById('ifNo').style.visibility = 'hidden';

          }
      </script>
        <div class = "right">
          <input type="radio" onclick="javascript:yesnoCheck();" name="yesNo" id="yesCheck" value = 1 checked>Yes</input>
          <input type="radio" onclick="javascript:yesnoCheck();" name="yesNo" id="noCheck" value = 0>No</input>
        </div>
      </p>
      <div id="ifNo" style="visibility:hidden">
        <div class= "left">
          <label class="Description">Why is it closed?</label>
        </div>
        <div class = "right">
          <input type="text" id="Description" name="Description" placeholder="Enter a description">
        </div>
      </div>
    </div>
  
    <?php //test
    $rowSQ = $conn->query("Select MAX(rideID) AS maxs FROM ride");
    $rows = $rowSQ->fetch_array();
    $largest = $rows['maxs'];
    ?>
    <script id="test">
      var larges= <?php echo json_encode(++$largest, JSON_HEX_TAG); ?>;
      //document.write("Test: " + larges);
    </script> 
    
    <p><tr><td><input type="submit" name="submit" value="Submit"/></td></tr></p>
  </form>
  </div>
<?php
$addUpdate = $_POST['Add_Update'];
$start = $_POST['StartDate'];
$end = $_POST['EndDate'];
$yesno = $_POST['yesNo'];
$ride = $_POST["RideID"];
$description = $_POST["Description"];
$id = $_POST["maintenanceSelect"];
$broken = $_POST['broken'];
if(isset($_POST['submit']))
{
  if($addUpdate == 1)
  {
    $sql = "INSERT INTO maintenancetickets (maintenanceID, DateStart, DateEnded, ClosedRain, RideID, Description) VALUES ('$largestNumber', '$start','$end',$yesno,'$ride','$description')";
  }
  else if($addUpdate == 0)
  {
    $sql = "UPDATE maintenancetickets SET maintenanceID='$id', DateStart='$start', DateEnded='$end', ClosedRain='$yesno', RideID='$ride', Description='$description' WHERE maintenanceID = '$id'";
  }
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
  /*
  $ql = "UPDATE ride SET isBroken = '$broken' WHERE RideID = '$ride'";
  if(!mysqli_query($conn,$ql))
  {
    echo mysqli_error($conn);
  }
  else
  {
    echo '<script>';
    echo 'alert("'.$ql.'\nInsert Complete")';
    echo '</script>';
  }
  */
}
mysqli_close($conn);
?>
  <script src="maintenance.js"></script>
  <noscript>You need to enable JavaScript to view the full site.</noscript>
</body>


</html>