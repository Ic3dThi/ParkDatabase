<?php
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>
<html>

<head>

    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>

<body>

    <?php 
    if(isset($_POST['register_button'])) {
        echo '
       <script>
       $(document).ready(function(){
           $("#first").hide();
           $("#second").show(); 
    })
       </script> 
        
    ';} ?>


    <div class="wrapper">
        <div class="login_box">
            <div class="login_header">
                <h1>Amusement Park Management</h1>
                Login or sign up below!
            </div>


            <div id="first">
                <form action="register.php" method="POST">
                    <input type="text" name="empid" placeholder="Employee ID" value="<?php if(isset($_SESSION['empid'])) {
            echo $_SESSION['empid'];}?>" required>
                    <br>
                    <input type="password" name="log_password" placeholder="Password" required>
                    <br>
                    <?php if(in_array("ID or password incorrect<br>", $error_array)) echo "ID or password incorrect<br>"?>
                    <input type="submit" name="login_button" value="Login">
                </form>

            </div>

            <div id="second">

                <form action="register.php" method="POST">
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];} ?>" required>
                    <br>
                    <?php if(in_array("Your first name must be between 2 and 25 characters<br>",$error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>


                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])) {
            echo $_SESSION['reg_lname'];} ?>" required>
                    <br>
                    <?php if(in_array("Your last name must be between 2 and 25 characters<br>",$error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>



                    <input type="text" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])) {
            echo $_SESSION['reg_email'];} ?>" required>
                    <br>
                    <?php if(in_array("Invalid E-mail<br>",$error_array)) echo "Invalid E-mail<br>";
        else if(in_array("Email already in use<br>",$error_array)) echo "Email already in use<br>"; ?>


                    <input type="password" name="reg_password" placeholder="Password" required>
                    <br>
                    <input type="password" name="reg_password2" placeholder="Retype Password" required>
                    <br>
                    <?php if(in_array("Your password do not match<br>",$error_array)) echo "Your password do not match<br>";
        else if(in_array("Your password can only contain english characters or numbers<br>",$error_array)) echo "Your password can only contain english characters or numbers<br>"; 
        else if (in_array("Your password must be between 5 and 30 characters<br>",$error_array)) echo "Your password must be between 5 and 30 characters<br>"; ?>


                    <input type="submit" name="register_button" value="Register">
                    <br>
                    <?php if(in_array("<span style='color: #14C800'> Registered! Please Login</span><br>",$error_array)) echo "<span style='color: #14C800'> Registered! Please Login</span><br>"; ?>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>

                </form>

            </div>

        </div>
    </div>
</body>

</html>