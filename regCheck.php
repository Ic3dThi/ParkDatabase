<?php

session_start();

$errorlabel = "Account already registered for this Employee ID";

if (isset($_POST["registerBtn"]))
{
    require("dhb.php");

    if ($mysqli->connect_errno) {
        unset($_SESSION["error"]);
        $errorlabel = "Unable to connect to DB";
        $_SESSION["error"] = $errorlabel;
        header("location: ../InformationPage.php");
        exit();
    }

    $EmpID = $_POST["EmployeeID"];
    $pass1 = $_POST["psw"];
    $pass2 = $_POST["psw-repeat"];
    $fname = $_POST["Firstname"];
    $lname = $_POST["Lastname"];
    $salary = 1;
    $phnum = $_POST["phoneNum"];
    $add = $_POST["address"];
    $sec = $_POST["section"];
    $pos = $_POST["pos"];
    
    $result = $mysqli->query("SELECT * FROM employee WHERE employeeID = $EmpID");

    if ($result->num_rows > 0)
    {
        unset($_SESSION["error"]);
        $_SESSION["error"] = $errorlabel;
        $mysqli->close();
        header("location: ../InformationPage.php?error=accountexists");
        exit();
    }
    if (!($pass1 == $pass2))
    {
        unset($_SESSION["error"]);
        $errorlabel = "Passwords do no match";
        $_SESSION["error"] = $errorlabel;
        $mysqli->close();
        header("location: ../InformationPage.php?error=PassNoMatch");
        exit();
    }

    /*
    if (!(is_numeric($salary)))
    {
        $errorlabel = "Salary is not a numeric value";
        $_SESSION["error"] = $errorlabel;
        $mysqli->close();
        header("location: ../InformationPage.php?error=SalaryWrongForm");
        exit();
    }
    */

    $insertquery = "INSERT INTO `employee` (`employeeID`, `employeePassword`, `firstName`, `lastName`, `salary`, `phoneNumber`, `address`, `FKEmployeeSection`, `position`) VALUES ('$EmpID', '$pass1', '$fname', '$lname', '$salary', '$phnum', '$add', '$sec', '$pos')";
        
    if (mysqli_query($mysqli, $insertquery))
    {
        $mysqli->close();
        header("location: middle.php");
        exit();
    }
    else
    {
        unset($_SESSION["error"]);
        $errorlabel = "Error inserting information";
        $_SESSION["error"] = $errorlabel;
        $mysqli->close();
        header("location: InformationPage.php?error=ErrQury");
        exit();
    }
}
else
{
    unset($_SESSION["error"]);
    $errorlabel = "Error in processing";
    $_SESSION["error"] = $errorlabel;
    header("location: InformationPage.php?error=NoSubmit");
    exit();
}

?>