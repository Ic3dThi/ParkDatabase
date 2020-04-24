<!doctype html>
<?php
session_start();
if(isset($_GET["empid"]))
{
  require("dhb.php");
  $errorlabel = "unable to connect";

  if ($mysqli->connect_errno) {
    $errorlabel = "Unable to connect to DB";
    $_SESSION["error"] = $errorlabel;
    header("location: ../InformationPage.php");
    exit();
  }


  $EmpID = $_GET["empid"];

  $result = $mysqli->query("SELECT * FROM employee WHERE employeeID = $EmpID");
  if ($result->num_rows == 0)
  {
    $errorlabel = "No such field exists";
    $_SESSION["error"] = $errorlabel;
    $mysqli->close();
    header("location: ../InformationPage.php?error=accountexists");
    exit();
  }
  
  $row = $result->fetch_assoc();
  $fname = $row["firstName"];
  $lname = $row["lastName"];
  $salary = $row["salary"];
  $address = $row["address"];
  $phoneNum = $row["phoneNumber"];
  $pos = $row["position"];
}
else
{
    header("location: register.php");
    exit();
    $empty = " ";
  $fname = $empty;
  $lname = $empty;
  $salary = $empty;
  $address = $empty;
  $phoneNum = $empty;
  $pos = $empty;
}

?>

<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <style>
      * {
        padding: 0;
        margin: 0;
      }
      .container-fluid {
        padding: 0;
        overflow-x: hidden;
      }
      .jumbotron {
        background-image: url("images/ferris.jpg");
        background-size: fill;
      }
      .card-img-top {
        height: 250px;
        width: 100%;
        object-fit: fill;
      }
      .col-sm-12.info {
        padding: 10px;
        align-items: center;
      }
      img {
        max-width: 100%;
        max-height: 100%;
      }
      .avatarpic {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
      }
    </style>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <div class="container-fluid p-0">
      <div class="row" style="padding: 0;">
        
        <div class = "col-sm-12" style="margin: 0;">
          <div class="jumbotron">
            <h1 class="display-1" style="color: rgb(255, 255, 255);">Welcome!</h1>
            <p class="lead" style="color: rgb(255, 255, 255);">Welcome to the Theme Park Management System!</p>
          </div>
          <div class="row">
            <div class = "col-sm-12" style="margin: 0;">
            
                <?php
                    require 'navbar.php';
                ?>

            </div>
            <div class="col-sm-12 text-center">
              <h2 style="color: #F26419;">Profile Information</h2>
              <hr />
            </div>
          </div>
          <div class = "d-flex flex-row justify-content-center p-3">
            <div class = "card shadow p-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <img class="avatarpic" src="images/avatar2.png" alt="avatarpic">
                  </div>
                  <div class="col-sm-6">
                    <div class="row">
                      <div class="col-sm-12">
                        <h3><?php echo "$fname $lname"; ?></h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <p style="margin: 0;"><p style="font-weight: bold; margin: 0;">Employee ID:</p><?php echo "$EmpID"; ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12">
                        <p style="margin: 0;"><p style="font-weight: bold;; margin: 0;">Position:</p><?php echo "$pos"; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row text-center">
                  <div class="col-sm-12 text-center">
                    <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">More Info</a>
                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                      <div class="row text-center">
                        <div class="col-sm-12 text-center"><p><p style="font-weight: bold; margin: 0;">Salary:</p><?php echo "$".number_format($salary, 2); ?></p></div>
                      </div>
                      <div class="row text-center">
                        <div class="col-sm-12 text-center"><p><p style="font-weight: bold; margin: 0;">Address:</p><?php echo "$address"; ?></p></div>
                      </div>
                      <div class="row text-center">
                        <div class="col-sm-12 text-center"><p><p style="font-weight: bold; margin: 0;">Phone Number:</p><?php echo "$phoneNum"; ?></p></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php
            if($pos == "Manager")
            {
                echo "<div class = \"d-flex flex-row justify-content-around p-3\">
                        <div class=\" card shadow p-3\" style = \"width: 18rem;\">
                        <div class = \"row\">
                            <div class = col-sm-3>
                            <img src=\"images/items.png\" alt=\"items image\">
                            </div>
                            <div class = \"col-sm-9\">
                            <div class = \"card-body\">
                                <h5 class = \"card-title align-center\">Add New User</h5>
                                <p class = \"card-text\">Register a new Employee</p>
                                <a href=\"InformationPage.php?empid=$EmpID\" class = \"btn btn-primary\">Registration</a>
                            </div>
                            </div>
                        </div>              
                        </div>
                    </div>";
            }
          ?>
          <br />
        </div>
      </div>
    </div>

  </body>
</html>