<!DOCTYPE html>
<html>
<head>
<title>Store Page</title>
<h1 style="text-align:center; font-size: 40px; border-style: solid; border-color:#f26419;border-width: thick";>Welcome!</h1>
<div>
<h2 style = "color: #3366ff"> Navigate with the menu below <h2/>
</div> 
</head> 

<?php 
include 'navbar.php';
$conn_error = "Could not connect";
// SQL connection credentials

$mysql_host = "q3vtafztappqbpzn.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$mysql_user = "wza2d7kuebod9xq1";
$mysql_pass = "a8lcu7qdeqvpasc0";
$mysql_name = "oznxdf1zh5a96rnv";
try{
$conn = mysqli_connect($mysql_host, $mysql_user, $mysql_pass,$mysql_name);

} catch (mysqli_sql_exception $ex) {
    echo 'Error';
}
?>

    <body>
`   <div> 
   <div     class="dropdown"  style="margin-left: 45%; margin-top: -26px">
          <button class="dropbtn">Price</button>
    <div  class="dropdown-content" style="left:0";>
    <form id="form" method="post" action=""> 

        <input type="checkbox" name="price1" class="checkbox" <?=(isset($_POST['price'])?' checked':'')?>/> $0 - 9.99<br>
        <input type="checkbox" name="price2" class="checkbox" <?=(isset($_POST['price'])?' checked':'')?>/> $10 - 19.99<br>
        <input type="checkbox" name="price3" class="checkbox" <?=(isset($_POST['price'])?' checked':'')?>/> $20 -29.99<br>
        <input type="checkbox" name="price4" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> Highest to Lowest <br>
        <input type="checkbox" name="price5" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> Lowest to Highest <br>
        <input type="checkbox" name="price6" class="checkbox" <?=(isset($_POST['price'])?' checked':'')?>/> Show All<br>

    </div>
    </div>

<div     class="dropdown"  style="margin-left: 1%;margin-top: -56px ">
          <button class="dropbtn">Store</button>
    <div  class="dropdown-content" style="left:0";>
    <form id="form" method="post" action="">
        <input type="checkbox" name="MainStore" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> Main Store <br>
        <input type="checkbox" name="NorthStore" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> North Store <br>
        <input type="checkbox" name="EastStore" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> East Store <br>
         <input type="checkbox" name="SouthStore" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> South Store<br>
         <input type="checkbox" name="WestStore" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> West Store<br>
        <input type="checkbox" name="Store" class="checkbox" <?=(isset($_POST['FKItemStore'])?' checked':'')?>/> Show All<br>
    </form>
    </div>
    </div>  
    </form>
    </div>


    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST") {
              if (isset($_POST["price1"])){
                $query = $conn->query("SELECT * FROM item WHERE price BETWEEN 0 AND 9.99");
            } elseif (isset($_POST["price2"])){
                $query = $conn->query("SELECT * FROM item WHERE price BETWEEN 10 AND 19.99");
            } elseif (isset($_POST["price3"])){
                $query = $conn->query("SELECT * FROM item WHERE price BETWEEN 20 AND 29.99");
            }
            elseif (isset($_POST["price4"])){
                $query = $conn->query("SELECT * FROM `item` ORDER BY `item`.`price` DESC");
            }
            elseif (isset($_POST["price5"])){
                $query = $conn->query("SELECT * FROM `item` ORDER BY `item`.`price` ASC");
            }
              elseif (isset($_POST["MainStore"])){
                $query = $conn->query("SELECT * FROM item WHERE FKItemStore = 1");
            } elseif (isset($_POST["NorthStore"])){
                $query = $conn->query("SELECT * FROM item WHERE FKItemStore = 2");
            }elseif (isset($_POST["EastStore"])){
                $query = $conn->query("SELECT * FROM item WHERE FKItemStore = 3");
            } 
            elseif (isset($_POST["SouthStore"])){
                $query = $conn->query("SELECT * FROM item WHERE FKItemStore = 4");
            }
            elseif (isset($_POST["WestStore"])){
                $query = $conn->query("SELECT * FROM item WHERE FKItemStore = 5");
            }
            else{
               $query = $conn->query("SELECT * FROM `item` ORDER BY `item`.`FKItemStore` ASC");
                
            }
        

            if($query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    ?>
                    <table style=" margin-top: 100px">
                    <tr>
                        <th><?php echo '<img src = "data:Image;base64,'.base64_encode($row["Image"]).'" alt="Image" style="width: 100px; height: 100px;" >'; ?> </th>
                        <th><?php echo $row["name"]; ?></th>
                        <th>Price: <?php echo $row["price"]; ?></th>
                        <th>Quantity: <?php echo $row["available"]; ?></th>
                        <!---<th>F:<?php echo $row["FKItemStore"];?></th> --->
                    </tr>
                    </table>
                    

                 
                <?php } 
            }else{
                echo  'Store product(s) currently sold out';
            }
        }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.checkbox').on('change',function(){
                $('#form').submit();
            });
        });
    </script>


<!---------CSS--------->

<style>

body {
    background-color: white;
    font-family: sans-serif;
  }

  h1{
    text-align: center;   
    font-family: sans-serif;
    margin-top: -10px;
  }
   h2{
    text-align: center;
    color:black; 
    font-family: sans-serif;
    margin-top:-10px;
    font-size:20px
  }
  
.dropbtn {
    background-color: #3366ff; 
    color: white; 
    padding: 16px;
    font-size: 20px;
    border: none;
    cursor: pointer;
  }
  
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  .dropdown-content {
    display: none;
    position: absolute;
    left:0; 
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  .dropdown-content a:hover {background-color: #809fff;}
  .dropdown:hover .dropdown-content {display: block;}
   table,tr,th,td
            {

                border: 0px;
                margin-left: auto;
                margin-right: auto;
            }

}
  </style>
  </body> 

  </html>