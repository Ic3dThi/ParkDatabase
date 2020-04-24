<?php 
require 'config/config.php';

if(isset($_SESSION['empid'])) {
    require 'dhb.php';
    $id = $_SESSION['empid'];
    $posQuery = "SELECT position FROM employee WHERE employeeID = $id";

    if($result = $mysqli->query($posQuery))
    {
        while($row = $result->fetch_assoc())
        {
            $pos = $row['position'];
        }
    }
    else
    {
        header("location: register.php");
    }
}
else {
    header("Location: register.php");
}
?>
<html>
<head>
    <Link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

    <div class="top_bar">
       <a href="middle.php"> Home </a>
       &nbsp;&nbsp;
       <?php
            if($pos == "Customer Service" || $pos == "Maintenance")
            {
                echo "<a href=\"Records.php\"> Records </a>
                &nbsp;&nbsp;";

                echo "<a href=\"maintenance.php\"> Maintenance </a>
                &nbsp;&nbsp;";
            }
        ?>
        <?php
            if($pos == "Sales")
            {
                echo "<a href=\"iteminsert.php\"> Edit Store </a>
                &nbsp;&nbsp;";

                echo "<a href=\"item.php\"> View Store </a>
                &nbsp;&nbsp;";
            }
        ?>
        <?php
            if($pos == "Manager")
            {
                echo "<a href=\"Records.php\"> Records </a>
                &nbsp;&nbsp;";

                echo "<a href=\"Reports.php\"> Reports </a>
                &nbsp;&nbsp;";

                echo "<a href=\"stats.php\"> Statistics </a>
                &nbsp;&nbsp;";

                echo "<a href=\"maintenance.php\"> Maintenance </a>
                &nbsp;&nbsp;";

                echo "<a href=\"iteminsert.php\"> Edit Store </a>
                &nbsp;&nbsp;";

                echo "<a href=\"item.php\"> View Store </a>
                &nbsp;&nbsp;";
            }
        ?>       
        <a href="logout.php"> Logout </a>
    </div>
</body>
   