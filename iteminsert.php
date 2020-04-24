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

<?php
function getPosts()
{
    $posts = array();
    $posts[0] = $_POST['itemID'];
    $posts[1] = $_POST['price'];
    $posts[2] = $_POST['available'];
    $posts[3] = $_POST['FKItemStore'];
    $posts[4] = $_POST['name'];
    $posts[5] = $_POST['Image'];
    return $posts;
}

if(isset($_POST['insert']))
{ 
  $data = getPosts();
  $image = addslashes(file_get_contents($_FILES["Image"]["tmp_name"])); 
  floatval($data[1]); 
  $insert_Query = "INSERT INTO `item` (`itemID`, `price`, `available`, `FKItemStore`, `name`,`Image`) VALUES ('$data[0]','$data[1]','$data[2])','$data[3]','$data[4]','$image')";
 try{
        $insert_Result = mysqli_query($conn, $insert_Query);
        
        if($insert_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                echo '<script language="javascript">';
                echo 'alert("Successfully inserted data!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Data not inserted.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Insert '.$ex->getMessage();
    }
}

if(isset($_POST['delete']))
{
    $data = getPosts();
    $delete_Query = "DELETE FROM `item` WHERE `itemID` = $data[0]";
    try{
        $delete_Result = mysqli_query($conn, $delete_Query);
        
        if($delete_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                echo '<script language="javascript">';
                echo 'alert("Successfully deleted data!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Data not deleted.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Delete '.$ex->getMessage();
    }
}

if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query =  "UPDATE `item` SET `price`=$data[1] WHERE itemID = $data[0]";
    try{
        $update_Result = mysqli_query($conn, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
               echo '<script language="javascript">';
                echo 'alert("Successfully updated price!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Could not update price.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query =  "UPDATE `item` SET `available`=$data[2] WHERE itemID = $data[0]";
    try{
        $update_Result = mysqli_query($conn, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                echo '<script language="javascript">';
                echo 'alert("Successfully updated availability!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Could not update availability")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

if(isset($_POST['update']))
{
    $data = getPosts();
    $update_Query =  "UPDATE `item` SET `FKItemStore`=$data[3] WHERE itemID = $data[0]";
    try{
        $update_Result = mysqli_query($conn, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                echo '<script language="javascript">';
                echo 'alert("Successfully updated Store!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Could not update store.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

if(isset($_POST['updateN']))
{
    $data = getPosts();
    $update_Query4 = "UPDATE `item` SET  `name`='".$data[4]."' WHERE `item`.itemID = $data[0]";
    try{
        $update_Result = mysqli_query($conn, $update_Query4);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
               echo '<script language="javascript">';
                echo 'alert("Successfully updated name!")';
                echo '</script>';
            }else{
               echo '<script language="javascript">';
                echo 'alert("Could not update name.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}

if(isset($_POST['updateimg']))
{
    $data = getPosts();
    $image = addslashes(file_get_contents($_FILES["Image"]["tmp_name"])); 
    $update_Query = "UPDATE `item` SET  `Image`='".$image."' WHERE `item`.itemID = $data[0]";
    try{
        $update_Result = mysqli_query($conn, $update_Query);
        
        if($update_Result)
        {
            if(mysqli_affected_rows($conn) > 0)
            {
                echo '<script language="javascript">';
                echo 'alert("Successfully updated image!")';
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("Could not update image.")';
                echo '</script>';
            }
        }
    } catch (Exception $ex) {
        echo 'Error Update '.$ex->getMessage();
    }
}
?>
<?php
if(isset($_POST['Search']))
{    
    $data = getPosts();
    
    $search_Query = "SELECT * FROM item WHERE itemID = $data[0]";
    
    $search_Result = mysqli_query($conn, $search_Query);
    
    if($search_Result)
    {
        if(mysqli_num_rows($search_Result))
        {
            while($row = mysqli_fetch_array($search_Result))
            {
                $itemID = $row['itemID'];
                $price = $row['price'];
                $available = $row['available'];
                $FKItemStore = $row["FKItemStore"];
                $name = $row['name'];
                ?>
                <h2>
                <?php echo "Image: \n<br /> "; ?>
                
               <?php echo '<img src = "data:Image;base64,'.base64_encode($row["Image"]).'" alt="Image" style="width: 80px; height: 80px;" >'; 
               ?>
                </h2>
<?php
            }
        }else{
             echo '<script language="javascript">';
                echo 'alert("Could not find item.")';
                echo '</script>';
        }
    }
}


?>

<html>
<h1 style="text-align: center; border-style: solid; border-color:#f26419;border-width: thick; ">Add/Edit Store </h1>
<h3>  Use Item ID to search, add, delete, and updating.</h3>
<body>
    <head>
        <title>INSERT UPDATE DELETE</title>
    </head>
    <body>
        <form action="iteminsert.php" method="post" enctype="multipart/form-data">
            <input type="number" name="itemID" placeholder="ItemID" value="<?php echo $itemID;?>"><br><br>
            <input type="text" name="price" placeholder="Item Price" value="<?php echo $price;?>"><br><br>
            <input type="number" name="available" placeholder="Item availability" value="<?php echo $available;?>"><br><br>
            <input type="number" name="FKItemStore" placeholder="1 = Main Store, 2 = North Store, 3 = East Store, 4 = South store, 5 = West Store" value="<?php echo $FKItemStore;?>"><br><br>
            <input type="text" name="name" placeholder="Name" value="<?php echo $name;?>"><br><br>
            <input type="file" name="Image" value="<?php echo $Image;?>"> <br><br> 

            <div>
            <!----Searching----> 
                <input type="submit" name="Search" value="Search">
                <!-- Input for adding -->
                <input type="submit" name="insert" value="Add" href="#" title="Add" class="Add" onclick="return confirm('Is everything filled out correctly? Item ID cannot be changed once submitted')">
                <!-- Input for deleting-->
                <input type="submit" name="delete" value="Delete"  href="#" title="delete" class="delete" onclick="return confirm('Are you sure you want to delete this item. Entire item will be deleted.')">
                <!-- Input for editing -->
                <input type="submit" name="update" value="Update" href="#" title="Add" class="Add" onclick="return confirm('Make sure you have the correct Item ID you want to update information for.')">
                <!-- Input for name and img update -->
                <input type="submit" name="updateN" value="Update Name" href="#" title="Add" class="Add" onclick="return confirm('Make sure you have the correct Item ID you want to update the name for.')">
                <input type="submit" name="updateimg" value="Update Image" href="#" title="Add" class="Add" onclick="return confirm('Make sure you have the correct Item ID you want to update the image for.')">


                

            </div>
        </form>

<!------- css styling -------> 

<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=file], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #3366ff;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #809fff;
}


div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

h2{
    position: relative;
    bottom: 0;
    left: 50%;
    right: 0; 
}

h3{
    position: relative; 
    text-align: center; 
    font-size: 16px;
}

</style>



        </body>
        </html>