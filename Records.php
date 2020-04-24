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
//echo "Connected successfully";
//easy way to make a query. 
//You can copy and past the next line and change the query however you want
$result=mysqli_query($conn, "SELECT * from item");
$result2=mysqli_query($conn, "SELECT * from ride");
$result3=mysqli_query($conn, "SELECT * from maintenancetickets");
$result4=mysqli_query($conn, "SELECT * from store");
$result5=mysqli_query($conn, "SELECT * from visitor");
$result6=mysqli_query($conn, "SELECT * from parksection");
$result7=mysqli_query($conn, "SELECT * from employee");
$result8=mysqli_query($conn, "SELECT * from ticket");


?>
<!doctype html>
<html>
  
<h1 style="text-align: center; border-style: solid; border-color:#f26419;border-width: thick; ">Database Records </h1>
<p style="font-weight:bold; color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Ticket Table: </p>

<form method="post" action="Records.php">
    <input type="text" style="background-color:#ddd"  name="q" placeholder="Search Query...">
    <select name="column" style="background-color:#ddd">
        <option value="" style="background-color:#f26419">Select Filter</option>
        <option value="ticketID" style="background-color:#f26419">Ticket ID</option>
        <option value="FKTicketRide" style="background-color:#f26419">FKTicketRide</option>
        <option value="PurchaseDate" style="background-color:#f26419">PurchaseDate</option>
        <option value="VisitorID" style="background-color:#f26419">VisitorID</option>
    </select>
    <input type="submit" name="submit" value="Find">
    </form>

<div class= "options">  
<?php

if(isset($_POST['submit']))
{
    $q=$conn->real_escape_string($_POST['q']);
    $column=$conn->real_escape_string($_POST['column']);

   /* if($column==""||($column!="ticketID"&&$column!="FKTicketRide"&&$column!="PurchaseDate"&&$column!="VisitorID"))
    $column="ticketID";*/

$sql=mysqli_query($conn, "SELECT ticketID FROM ticket WHERE $column LIKE '%$q%'");
if($sql->num_rows>0)
{   echo "Results: ";
    echo "<br>";
    while($data=$sql->fetch_array())
        echo $data['ticketID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>


<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Visitor Table: </p>

<form method="post" action="Records.php">
    <input type="text" style="background-color:#ddd" name="m" placeholder="Search Query...">
    <select name="column1" style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="visitorID"style="background-color:#f26419">Visitor ID</option>
        <option value="LastName"style="background-color:#f26419">Last Name</option>
        <option value="FirstName"style="background-color:#f26419">First Name</option>
        <option value="DateLastVisited"style="background-color:#f26419">Date Last Visited</option>
    </select>
    <input type="submit" name="submit1" value="Find">
    </form>

<div class= "options">  

<?php

if(isset($_POST['submit1']))
{
    
    $m=$conn->real_escape_string($_POST['m']);
    $column1=$conn->real_escape_string($_POST['column1']);

    /*
    if($column1==""||($column1!="visitorID"&&$column1!="LastName"&&$column1!="FirstName"&&$column1!="DateLastVisited"))
    $column1="visitorID";*/


$sql1=mysqli_query($conn, "SELECT visitorID FROM visitor WHERE $column1 LIKE '%$m%'");
if($sql1->num_rows>0)
{   echo "Results: ";
    echo "<br>";
    while($data1=$sql1->fetch_array())
        echo $data1['visitorID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>
<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Item Table: </p>

<form method="post" action="Records.php">
    <input type="text"  style="background-color:#ddd" name="a" placeholder="Search Query...">
    <select name="column2"style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="itemID"style="background-color:#f26419">Item ID</option>
        <option value="price"style="background-color:#f26419">Price</option>
        <option value="available"style="background-color:#f26419">Amount Available</option>
        <option value="FKItemStore"style="background-color:#f26419">Item Store</option>
        <option value="name"style="background-color:#f26419">Name</option>
    </select>
    <input type="submit" name="submit2" value="Find">
    </form>
<div class="options">
<?php

if(isset($_POST['submit2']))
{
    $a=$conn->real_escape_string($_POST['a']);
    $column2=$conn->real_escape_string($_POST['column2']);


$sql2=mysqli_query($conn, "SELECT itemID FROM item WHERE $column2 LIKE '%$a%'");
if($sql2->num_rows>0)
{echo "Results: ";
    echo "<br>";
    while($data2=$sql2->fetch_array())
        echo $data2['itemID']."<br>";
}
else{
    echo "Your seach query doesn't match any data!";
}
}
?>
</div>

<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Maintenance Table: </p>

<form method="post" action="Records.php">
    <input type="text"  style="background-color:#ddd" name="c" placeholder="Search Query...">
    <select name="column4"style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="maintenanceID"style="background-color:#f26419">Maintenance ID</option>
        <option value="DateStart"style="background-color:#f26419">Date Started</option>
        <option value="DateEnded"style="background-color:#f26419">Date Ended</option>
        <option value="ClosedRain"style="background-color:#f26419">Closed(0/1)</option>
        <option value="RideID"style="background-color:#f26419">Ride ID</option>

    </select>
    <input type="submit" name="submit4" value="Find">
    </form>

<div class="options">
<?php

if(isset($_POST['submit4']))
{
    $c=$conn->real_escape_string($_POST['c']);
    $column4=$conn->real_escape_string($_POST['column4']);


$sql4=mysqli_query($conn, "SELECT maintenanceID FROM maintenancetickets WHERE $column4 LIKE '%$c%'");
if($sql4->num_rows>0)
{
    echo "Results: ";
    echo "<br>";
    while($data4=$sql4->fetch_array())
        echo $data4['maintenanceID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>

<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Ride Table: </p>

<form method="post" action="Records.php">
    <input type="text" style="background-color:#ddd" name="d" placeholder="Search Query...">
    <select name="column5"style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="rideID"style="background-color:#f26419">Ride ID</option>
        <option value="name"style="background-color:#f26419">Name</option>
        <option value="type"style="background-color:#f26419">Ride Type</option>
        <option value="broken"style="background-color:#f26419">Broken Code</option>
        <option value="sectionID"style="background-color:#f26419">Section ID</option>

    </select>
    <input type="submit" name="submit5" value="Find">
    </form>
<div class="options">

<?php

if(isset($_POST['submit5']))
{
    $d=$conn->real_escape_string($_POST['d']);
    $column5=$conn->real_escape_string($_POST['column5']);


$sql5=mysqli_query($conn, "SELECT RideID FROM ride WHERE $column5 LIKE '%$d%'");
if($sql5->num_rows>0)
{echo "Results: ";
    echo "<br>";
    while($data5=$sql5->fetch_array())
        echo $data5['RideID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>
<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Store Table: </p>

<form method="post" action="Records.php">
    <input type="text" style="background-color:#ddd" name="e" placeholder="Search Query...">
    <select name="column6"style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="StoreID"style="background-color:#f26419">Store ID</option>
        <option value="FKStoreSection"style="background-color:#f26419">FK Store Section</option>
        <option value="name"style="background-color:#f26419">Name of store</option>

    </select>
    <input type="submit" name="submit6" value="Find">
    </form>

<div class="options">
<?php

if(isset($_POST['submit6']))
{
    $e=$conn->real_escape_string($_POST['e']);
    $column6=$conn->real_escape_string($_POST['column6']);


$sql6=mysqli_query($conn, "SELECT StoreID FROM store WHERE $column6 LIKE '%$e%'");
if($sql6->num_rows>0)
{echo "Results: ";
    echo "<br>";
    while($data6=$sql6->fetch_array())
        echo $data6['StoreID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>

<p style="font-weight:bold;color:#3366ff; font-family:Arial, Helvetica, sans-seriff">Filter Section Table: </p>

<form method="post" action="Records.php">
    <input type="text" style="background-color:#ddd" name="f" placeholder="Search Query...">
    <select name="column7"style="background-color:#ddd">
        <option value=""style="background-color:#f26419">Select Filter</option>
        <option value="SectionID"style="background-color:#f26419">Section ID</option>
        <option value="name"style="background-color:#f26419">Name</option>
        

    </select>
    <input type="submit" name="submit7" value="Find">
    </form>

<div class="options">

<?php

if(isset($_POST['submit7']))
{
    $f=$conn->real_escape_string($_POST['f']);
    $column7=$conn->real_escape_string($_POST['column7']);


$sql7=mysqli_query($conn, "SELECT SectionID FROM parksection WHERE $column7 LIKE '%$f%'");
if($sql7->num_rows>0)
{
    echo "Results: ";
    echo "<br>";
    while($data7=$sql7->fetch_array())
        echo $data7['SectionID']."<br>";
}
else{
    echo "Your search query doesn't match any data!";
}
}
?>
</div>

<!--

<p>The most popular:</p>
<input type="radio"  name="actions" value="RidePop" id="ridePop" class="popular" />
          <label for="item">Ride &nbsp;</label>

<input type="radio" name="actions" value="ItemPop" id="itemPop" class="popular"/>
          <label for="ride">Item from store<br></label>
  -->

<!--
<div class="group">
          <label for="popular">The most popular:</label>

          <select id="popularity">
            <option value="rides">Ticket purchased</option>
            <option value="type">Ride type</option>
            <option value="sections">Park section</option>
            <option value="stores">Store</option>
            <option value="day">Calendar day</option>

          </select>
</div><br> 
  -->
    <br><h3 style="text-align:center; color:#3366ff;
    font-family:Arial, Helvetica, sans-seriff">Choose Specific Table:</h3><br>

<div class="buttons">
<input type="radio" checked="checked" name="actions" value="Item" id="item" class="static_class" />
          <label for="item">Item &nbsp;</label>

<input type="radio" name="actions" value="Ride" id="ride" class="static_class"/>
          <label for="ride">Ride </label>

<input type="radio" name="actions" value="Maintenance" id="maintenance" class="static_class"/>
          <label for="maintenance">Maintenance </label>

<input type="radio" name="actions" value="Store" id="store" class="static_class"/>
          <label for="store">Store </label>

<input type="radio"name="actions" value="Visitor" id="visitor" class="static_class"/>
          <label for="visitor">Visitor </label>

<input type="radio" name="actions" value="Section" id="section" class="static_class"/>
          <label for="section">Section </label>


 <input type="radio"name="actions" value="Ticket" id="ticket" class="static_class"/>
          <label for="ticket">Ticket </label>
</div>
           <script src="http://code.jquery.com/jquery.js"></script>

    <script type="text/javascript">
      $(function(){
        $(".static_class").click(function()
        {
           if($(this).val() === "Item")
          {
            $("#rideTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#storeTable").hide("fast");
            $("#visitorTable").hide("fast")
            $("#sectionTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#itemTable").show("fast");

          }
           else if($(this).val() === "Ride")
           {
            $("#itemTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#storeTable").hide("fast");
            $("#visitorTable").hide("fast");
            $("#sectionTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#rideTable").show("fast");

            }
            else if($(this).val() === "Maintenance")
           {
            $("#rideTable").hide("fast");
            $("#storeTable").hide("fast");
            $("#visitorTable").hide("fast");
            $("#itemTable").hide("fast");
            $("#sectionTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#maintenanceTable").show("fast");


            }
            else if($(this).val() === "Store")
           {
            $("#itemTable").hide("fast");
            $("#rideTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#visitorTable").hide("fast");
            $("#sectionTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#storeTable").show("fast");

            }

            else if($(this).val() === "Visitor")
           {  
            $("#itemTable").hide("fast");
            $("#rideTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#storeTable").hide("fast");
            $("#sectionTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#visitorTable").show("fast");

            }

            else if($(this).val() === "Section")
           {
            $("#itemTable").hide("fast");
            $("#rideTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#storeTable").hide("fast");    
            $("#visitorTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").hide("fast");
            $("#sectionTable").show("fast");

            }

    

            else
           {
            $("#itemTable").hide("fast");
            $("#rideTable").hide("fast");
            $("#maintenanceTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#storeTable").hide("fast");
            $("#visitorTable").hide("fast");
            $("#employeeTable").hide("fast");
            $("#ticketTable").show("fast");

            }

        });
      });
    </script>
<body>
<div id="itemTable">
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="5"><h2>Item records</h2></th>
    </tr>
    <t>
        <th>ID</th>
        <th>Price</th>
        <th>Availability</th>
        <th>Item Store</th>
        <th>Name</th>

    </t>
    
    <?php

    while($rows=$result->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['itemID']; ?></td>
        <td> <?php echo $rows['price']; ?></td>
        <td> <?php echo $rows['available']; ?></td>
        <td> <?php echo $rows['FKItemStore']; ?></td>
        <td> <?php echo $rows['name']; ?></td>

    </tr>
    <?php
    }
?>
</table>
</div>
<div id="rideTable">

<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="5"><h2>Ride records</h2></th>
    </tr>
    <t>
        <th>Ride ID</th>
        <th>Name</th>
        <th>Ride Type</th>
        <th>Broken ID</th>
        <th>Park Section ID</th>

    </t>
    <?php
    while($rows=$result2->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['RideID']; ?></td>
        <td> <?php echo $rows['name']; ?></td>
        <td> <?php echo $rows['type']; ?></td>
        <td> <?php echo $rows['broken']; ?></td>
        <td> <?php echo $rows['sectionID']; ?></td>

    </tr>
    <?php
    }
?>
</table>
</div>
<div id="maintenanceTable">
<table align="center" border="1px" style="width:630px; line-height:40px;">
    <tr>
        <th colspan="6"><h2>Maintenance</h2></th>
    </tr>
    <t>
        <th>Maintenance ID</th>
        <th>Date Start</th>
        <th>Date Ended</th>
        <th>Rain Closure</th>
        <th>Ride ID</th>

    </t>
    <?php
    while($rows=$result3->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['maintenanceID']; ?></td>
        <td> <?php echo $rows['DateStart']; ?></td>
        <td> <?php echo $rows['DateEnded']; ?></td>
        <td> <?php echo $rows['ClosedRain']; ?></td>
        <td> <?php echo $rows['RideID']; ?></td>


    </tr>
    <?php
    }
?>
</table>
</div>

<div id="storeTable">

<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="3"><h2>Store records</h2></th>
    </tr>
    <t>
        <th>Store ID</th>
        <th>Store Section</th>
        <th>Name</th>
    
    </t>
    <?php
    while($rows=$result4->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['StoreID']; ?></td>
        <td> <?php echo $rows['FKStoreSection']; ?></td>
        <td> <?php echo $rows['name']; ?></td>

    </tr>
    <?php
    }
?>
</table>
</div>
<div id="visitorTable">
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="4"><h2>Visitors</h2></th>
    </tr>
    <t>
        <th>Visitor ID</th>
        <th>Last Name</th>
        <th>First Name</th>
        <th>Date Last Visited</th>

    </t>
    <?php
    while($rows=$result5->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['visitorID']; ?></td>
        <td> <?php echo $rows['LastName']; ?></td>
        <td> <?php echo $rows['FirstName']; ?></td>
        <td> <?php echo $rows['DateLastVisited']; ?></td>

    </tr>
    <?php
    }
?>
</table>
</div>

<div id="sectionTable">
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="2"><h2>Section</h2></th>
    </tr>
    <t>
        <th>Section ID</th>
        <th>Name</th>

    </t>
    <?php
    while($rows=$result6->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['SectionID']; ?></td>
        <td> <?php echo $rows['name']; ?></td>
    
    </tr>
    <?php
    }
?>
</table>
</div>



<div id="ticketTable">
<table align="center" border="1px" style="width:600px; line-height:40px;">
    <tr>
        <th colspan="4"><h2>Tickets</h2></th>
    </tr>
    <t>
        <th>Ticket ID</th>
        <th>Ticket Ride</th>
        <th>Purchase Date</th>
        <th>Visitor ID</th>

    </t>
    <?php
    while($rows=$result8->fetch_array())//function to display data
    {
    ?>
    <tr>
        <td> <?php echo $rows['ticketID']; ?></td>
        <td> <?php echo $rows['FKTicketRide']; ?></td>
        <td> <?php echo $rows['PurchaseDate']; ?></td>
        <td> <?php echo $rows['VisitorID']; ?></td>

    </tr>
    <?php
    }
?>
</table>
</div>
</body>

  </html>

   <style>
   *{
       background-color:light-gray;
   }

   .options
   {
       color:#f26419; 
       font-family:Arial, Helvetica, sans-seriff;
   }

input[type="radio"]{
     
    margin-left:95px;
    margin-bottom:40px;



}

   input[type="submit"]{
  background-color: #3366ff;
  border: none;
  color: white;
  text-decoration: none;
  cursor: pointer;
}
.buttons{
color:#f26419;
font-family:Arial, Helvetica, sans-seriff;
font-weight:bold;

}
   </style>
   

