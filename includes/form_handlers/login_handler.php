<?php
if(isset($_POST['login_button'])) {
    $id = filter_var($_POST['empid']); //sanitize email
    $_SESSION['empid'] = $id; //Store email into session variable
    $password = $_POST['log_password']; //Get password


    $check_database_query = mysqli_query($con, "SELECT * FROM employee WHERE employeeID='$id' AND employeePassword='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if($check_login_query == 1){
        header("location: profileinfo.php?empid=$id");
        exit();
    }
    else{
        array_push($error_array, "ID or password incorrect<br>");
    }
}
?>