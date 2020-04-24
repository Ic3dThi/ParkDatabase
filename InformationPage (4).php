<!DOCTYPE html>

<?php
  session_start();

  if(isset($_GET["empid"]))
  {
      $_SESSION["empid"] = $_GET["empid"];
  }
  else
  {
      $EmpID = "";
  }
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript">

  function test2 () {
    print("Nothing");
  }

  function test (){
    var pass = document.getElementById("pass1").value;
    var pass2 = document.getElementById("pass2").value;
    var exists = "<?php echo $check ?>";

    if(exists == "Yes")
    {
      document.getElementById("errormsg").innerHTML = "An account already exists with this Employee ID.";
      document.getElementById("errormsg").style.visibility = "visible";
      document.getElementById("myForm").reset();
      return false;
    }
  
    if (!(pass == pass2)){
      document.getElementById("errormsg").innerHTML = "The passwords do not match";
      document.getElementById("errormsg").style.visibility = "visible";
      document.getElementById("pass1").value = "";
      document.getElementById("pass2").value = "";
      return false;
    }
  
    window.location.href = "http://parkdatabase3000.epizy.com/profileinfo.php";
  
  }
</script>

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: lightblue;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerInfobtn {
  background-color: rgb(255, 82, 29);
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}

</style>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>


<body>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <div class = "container">
    <div class="row display-flex">
      <div class="col-sm-12 text-left">
        <h1>Registration</h1>
        <p>Please fill out the form with your information.</p>
        <hr>
      </div>
    </div>

    <div class = "row display-flex align-items-center">

      <div class="col-sm-8 text-left">

        <form id="InfoForm" action="regCheck.php" method="POST">

          <div class="container">
                    
            <div class="row">
              <div class="col-sm-12 text-left">
                <p>* All fields are required</p>
              </div>
            </div>
        
            <div class="row">  
              <div class=col-sm-12>
                <label for="psw"><b>Password</b></label>
                <input type="password" id="pass1" placeholder="Enter Password" name="psw" maxlength="45" required> 
              </div>
            </div>
        
            <div class="row">
              <div class = "col-sm-12">
                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input type="password" id="pass2" placeholder="Repeat Password" name="psw-repeat" maxlength="45" required>
              </div>
            </div>
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="EmployeeID"><b>Employee ID</b></label>
                <input type="text" id="EmpID" placeholder="Enter Employee ID" name="EmployeeID" maxlength="15" required>
              </div>
            </div>
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="Firstname"><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" name="Firstname" maxlength="45" required>
              </div> 
            </div>
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="Lastname"><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" name="Lastname" maxlength="45" required>
              </div>
            </div>
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="phoneNum"><b>Phone Number</b></label>
                <input type="text" placeholder="Enter Phone Number" name="phoneNum" maxlength="45" required>
              </div>
            </div> 
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="address"><b>Address</b></label>
                <input type="text" placeholder="Enter Address" name="address" maxlength="45" required>
              </div>
            </div> 
        
            <div class = "row">
              <div class = "col-sm-12">
                <label for="section"><b>Park Section </b></label>
                <select class="custom-select-lg" id="section" name="section" required>
                    <option value="" disabled selected>Choose section</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
              </div>
            </div>

            <br />

            <div class = "row">
              <div class = "col-sm-12">
                <label for="pos"><b>Work Position</b></label>
                <select class="custom-select-lg" id="positions" name="pos" required>
                    <option value="" disabled selected>Choose position</option>
                    <option value="Manager">Manager</option>
                    <option value="Sales">Sales</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Maintenance">Maintenance</option>
                </select>
              </div>
            </div>
            
            <hr>
            
            <label id="errormsg" style="color: red;">
              <?php 

                if(isset($_SESSION["error"])){
                  $error = $_SESSION["error"];
                  echo "$error";
                }
              ?>
            </label>
            <button type="submit" name="registerBtn" class="registerInfobtn">submit</button>
            <br />        
          </div>          
        </form>
        <a href="middle.php">Return to Profile Page</a>
      </div>
    </div>
  </div>

</body>
</html>

<?php
  unset($_SESSION["error"]);
?>
