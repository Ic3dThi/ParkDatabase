

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

$q1=mysqli_query($conn, "SELECT t.FKTicketRide AS sum FROM ticket t GROUP BY t.FKTicketRide ORDER BY t.FKTicketRide DESC LIMIT 1");

$q5=mysqli_query($conn, "SELECT COUNT(*) AS num
FROM ticket t
GROUP BY t.FKTicketRide
ORDER BY num DESC, t.FKTicketRide DESC
LIMIT 1");

$q2=mysqli_query($conn,"SELECT COUNT(visitorID) as checker FROM visitor");

$q3=mysqli_query($conn,"SELECT r.RideID, name FROM ride r GROUP BY r.broken ORDER BY r.broken DESC LIMIT 1");


///////////////////////////////////////////////////////////
$q4=mysqli_query($conn,"SELECT SUBSTRING(m.DateStart, 6, 2) AS MONTH
FROM maintenancetickets m
WHERE m.ClosedRain = 1
GROUP BY month
ORDER BY month Asc
LIMIT 12");

$q7=mysqli_query($conn,"SELECT COUNT(*) AS Y
FROM maintenancetickets m
WHERE m.ClosedRain = 1
GROUP BY SUBSTRING(m.DateStart, 6, 2)
ORDER BY SUBSTRING(m.DateStart, 6, 2) Asc
LIMIT 12");
////////////////////////////////////////////////////////////////////////////




?>

<!DOCTYPE html>

<html lang="en">
<body>
<style>

*{
font-size:23px;
}
 </style>
    <h1 style="text-align:center; font-size: 40px; border-style: solid; border-color:#f26419;border-width: thick";>Park Statistics</h1>

    <p style ="color:#3366ff; font-family:Arial, Helvetica, sans-seriff">The Most Popular Ride: </p>
    <?php

    while($rows6=$q1->fetch_array())
{   $test=$rows6['sum'];
    //echo $test; 

}
if($test==1)
{
    echo "Speed Train Ridden Total Of: ";
}

else if($test==2)
{
    echo "Fun Cups Ridden Total Of: ";
}

else if($test==3)
{
    echo "Tunnel of Infatuation Ridden A Total Of : ";
}

else if($test==4)
{
    echo "Iron Man Ridden A total Of : ";
}


while($rows7=$q5->fetch_array())
{
    echo $rows7['num'];
    echo " Times";

}

?>
    

    <p style= "color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Total Number of Visitors: </p>

    <?php
    while($rows2=$q2->fetch_array())
    {
    echo $rows2['checker']; 

    }

    ?>

    <p style= "color:#3366ff; font-family:Arial, Helvetica, sans-seriff">The Most Broken Down Ride: </p>
    <?php
    while($rows3=$q3->fetch_array())
    {
    echo $rows3['name']; 

    }

    ?>




    <p style="color:#3366ff; font-family:Arial, Helvetica, sans-seriff">The Number of Rainouts per Month: </p>
    <?php
    echo "Months That It Has Rained:   ";
    //echo "  ";
    while($rows4=$q4->fetch_array())
    {
       //echo $rows4['MONTH']; 
       $Months=chunk_split($rows4['MONTH'], 2, ' ');
       echo $Months;
    }
echo "<br>";

    echo "Num. Of Times Per Month: ";

    while($rows9=$q7->fetch_array())
    {   
        
       echo "0". $rows9['Y'] . " "; 
       
    }

    ?>
</body>
</html>

<?php
