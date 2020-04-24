<?php 
include 'navbar.php';
$servername="q3vtafztappqbpzn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$username = "wza2d7kuebod9xq1";
$password = "a8lcu7qdeqvpasc0";
$db = "oznxdf1zh5a96rnv";
$conn = NEW MySQLi($servername, $username, $password,$db);
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>

<!doctype html>
<html>
<body>
<h1 style="text-align: center; border-style: solid; border-color:#f26419;border-width: thick; ">Reports </h1>

<form class="daterangeform" method="POST" action="Reports.php">
                <fieldset id="daterangefield">
                    <legend><b>Number Of Visitors</b></legend>
                    <div class= "group1">
                        <div class = "group2">
                            <label for="fromdate"> From </label>
                            <br/>
                            <input type="date" name="fromdate"  required/>
                        </div>
                        <div class = "group2">
                            <label for="todate"> To </label>
                            <br/>
                            <input type="date" name="todate" required/>
                        </div>
                        <br/>
                    </div>
                </fieldset>
                <br/>
                    <div class="formbuttons">
                        <input name= "formsubmit" id="formsubmit" type="submit" value="Generate" />
                    </div>
</form>


<?php

if(isset($_POST['formsubmit']))
{ 
  // Gets the date from the POST method
  $fdate = $_POST['fromdate'];
  $tdate = $_POST['todate'];

    // Query to get First Name and Last Name of the visitors that visited within the time range. Can modify this query to get other data as well such as the visitorID of the person.
    $namequery = "SELECT LastName, FirstName FROM visitor WHERE visitorID IN (SELECT VisitorID FROM ticket WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate')";

    // Query to get the number of visitors that came into the park withing the time range.
    $visits = mysqli_query($conn,"SELECT COUNT(*) AS total FROM ticket WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate'");

    // Query to get all the rides that were ridden in the time range and the amount of times that each ride was ridden. Can be modified to return the amount of times a specific ride was ridden in the time range.
    $rideCount = "SELECT name, COUNT(*) AS total FROM ticket INNER JOIN ride ON ticket.FKTicketRide = ride.RideID WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate' GROUP BY name";

    // Query to get all the rides which had a maintenance ticket, and the amount of times that a maintenance ticket was started, for that ride within the time range chosen. Can be modified to create other maintenance tickets such as the         amount of times a maintenance ticket was closed for a specific ride in a given time range.
    $brokenRideCount = "SELECT name, COUNT(*) AS total FROM ride INNER JOIN maintenancetickets ON ride.RideID = maintenancetickets.RideID WHERE DateStart BETWEEN '$fdate' AND '$tdate' GROUP BY name";

    $q2=mysqli_query($conn,$brokenRideCount);
    $row0=$visits->fetch_array();
    $largestNum=$row0['total'];
    if(mysqli_query($conn,$brokenRideCount))  // Checking to see whether the query was successfull
    {
        //echo "Successful ";
        echo "Total Number of Visitors During The Requested Dates: ";
        echo $largestNum;
        echo "<br>";
        echo "<br>";
        echo "Showing Results Between ".$fdate." And ".$tdate;

    }
    else
    {
        echo "Unsuccessful ";
    }
}

?>
<p></p<br>
<form class="daterangeform2" method="POST" action="Reports.php">
                <fieldset id="daterangefield2">
                    <legend><b>Visitor Names</b></legend>
                    <div class= "group12">
                        <div class = "group22">
                            <label for="fromdate"> From </label>
                            <br/>
                            <input type="date" name="fromdate2"  required/>
                        </div>
                        <div class = "group2">
                            <label for="todate"> To </label>
                            <br/>
                            <input type="date" name="todate2" required/>
                        </div>
                        <br/>
                    </div>
                </fieldset>
                <br/>
                    <div class="formbuttons">
                        <input name= "formsubmit2" id="formsubmit2" type="submit" value="Generate" />
                    </div>
</form>


<?php

if(isset($_POST['formsubmit2']))
{ 
  // Gets the date from the POST method
  $fdate = $_POST['fromdate2'];
  $tdate = $_POST['todate2'];

    // Query to get First Name and Last Name of the visitors that visited within the time range. Can modify this query to get other data as well such as the visitorID of the person.
    $brokenRideCount = "SELECT name, COUNT(*) AS total FROM ride INNER JOIN maintenancetickets ON ride.RideID = maintenancetickets.RideID WHERE DateStart BETWEEN '$fdate' AND '$tdate' GROUP BY name";


//one im using trying to output LastName and FirstName into an html table//
    $namequery = "SELECT LastName, FirstName FROM visitor WHERE visitorID IN (SELECT VisitorID FROM ticket WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate')";

    $names=mysqli_query($conn,$namequery);

    $q2=mysqli_query($conn,$brokenRideCount);

    if(mysqli_query($conn,$brokenRideCount))//should always execute if generate button was pressed. for testing
    {
        
        echo"<table border='2' id='total'>";
        echo"<tr><th>Last Name</th><th>First Name</th></tr>";
        while($rows=$names->fetch_array())
        {
            
         echo"<tr><td>";
        echo $rows['LastName'];
        echo"</td><td>";
        echo $rows['FirstName'];
        echo "</td></tr>";
      

        }
        echo "</table>";
        echo "<br>";
        echo "Showing Results Between ".$fdate." And ".$tdate;


    }
    else
    {
        echo "Unsuccessful ";
    }
}

?>
<p></p<br>
<form class="daterangeform3" method="POST" action="Reports.php">
                <fieldset id="daterangefield3">
                    <legend><b>Rides Ridden</b></legend>
                    <div class= "group13">
                        <div class = "group23">
                            <label for="fromdate"> From </label>
                            <br/>
                            <input type="date" name="fromdate3"  required/>
                        </div>
                        <div class = "group2">
                            <label for="todate"> To </label>
                            <br/>
                            <input type="date" name="todate3" required/>
                        </div>
                        <br/>
                    </div>
                </fieldset>
                <br/>
                    <div class="formbuttons">
                        <input name= "formsubmit3" id="formsubmit3" type="submit" value="Generate" />
                    </div>
</form>

<?php

if(isset($_POST['formsubmit3']))
{ 
  // Gets the date from the POST method
  $fdate = $_POST['fromdate3'];
  $tdate = $_POST['todate3'];

    // Query to get First Name and Last Name of the visitors that visited within the time range. Can modify this query to get other data as well such as the visitorID of the person.
    $brokenRideCount = "SELECT name, COUNT(*) AS total FROM ride INNER JOIN maintenancetickets ON ride.RideID = maintenancetickets.RideID WHERE DateStart BETWEEN '$fdate' AND '$tdate' GROUP BY name";


// Query to get all the rides that were ridden in the time range and the amount of times that each ride was ridden. Can be modified to return the amount of times a specific ride was ridden in the time range.
    $rideCount = "SELECT name, COUNT(*) AS total FROM ticket INNER JOIN ride ON ticket.FKTicketRide = ride.RideID WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate' GROUP BY name";

    $rides=mysqli_query($conn,$rideCount);

    $q2=mysqli_query($conn,$brokenRideCount);

    if(mysqli_query($conn,$brokenRideCount))//should always execute if generate button was pressed. for testing
    {
        echo"<table border='2' id='total'>";
        echo"<tr><th>Ride Name</th><th>Times Ridden</th></tr>";
        while($rows=$rides->fetch_array())
        {
            
         echo"<tr><td>";
        echo $rows['name'];
        echo"</td><td>";
        echo $rows['total'];
        echo "</td></tr>";
      

        }
        echo "</table>";
        echo "<br>";
        echo "Showing Results Between ".$fdate." And ".$tdate;

    }
    else
    {
        echo "Unsuccessful ";
    }
}

?>
<p></p<br>
<form class="daterangeform4" method="POST" action="Reports.php">
                <fieldset id="daterangefield4">
                    <legend><b>Ride Maintenance</b></legend>
                    <div class= "group14">
                        <div class = "group24">
                            <label for="fromdate"> From </label>
                            <br/>
                            <input type="date" name="fromdate4"  required/>
                        </div>
                        <div class = "group2">
                            <label for="todate"> To </label>
                            <br/>
                            <input type="date" name="todate4" required/>
                        </div>
                        <br/>
                    </div>
                </fieldset>
                <br/>
                    <div class="formbuttons">
                        <input name= "formsubmit4" id="formsubmit4" type="submit" value="Generate" />
                    </div>
</form>


<?php

if(isset($_POST['formsubmit4']))
{ 
  // Gets the date from the POST method
  $fdate = $_POST['fromdate4'];
  $tdate = $_POST['todate4'];


// Query to get the number of visitors that came into the park withing the time range.
    $visits = mysqli_query($conn,"SELECT COUNT(*) AS total FROM ticket WHERE PurchaseDate BETWEEN '$fdate' AND '$tdate'");
    
// Query to get all the rides which had a maintenance ticket, and the amount of times that a maintenance ticket was started, for that ride within the time range chosen. Can be modified to create other maintenance tickets such as the         amount of times a maintenance ticket was closed for a specific ride in a given time range.
    $brokenRideCount = "SELECT name, COUNT(*) AS total FROM ride INNER JOIN maintenancetickets ON ride.RideID = maintenancetickets.RideID WHERE DateStart BETWEEN '$fdate' AND '$tdate' GROUP BY name";

    $broken=mysqli_query($conn,$brokenRideCount);

    $q2=mysqli_query($conn,$visits);

    if(mysqli_query($conn,$brokenRideCount))//should always execute if generate button was pressed. for testing
    {
        echo"<table border='2' id='total'>";
        echo"<tr><th>Ride Name</th><th>Number Of Maintenance Tickets</th></tr>";
        while($rows=$broken->fetch_array())
        {
            
         echo"<tr><td>";
        echo $rows['name'];
        echo"</td><td>";
        echo $rows['total'];
        echo "</td></tr>";
      
        }
        echo "</table>";
        echo "<br>";
        echo "Showing Results Between ".$fdate." And ".$tdate;

    }
    else
    {
        echo "Unsuccessful ";
    }
}

?>

</body>
</html>
<style>

</style>
