<?php 
require 'config/config.php';
if(isset($_SESSION['empid'])) {
    $id = $_SESSION['empid'];
    header("location: profileinfo.php?empid=$id");
}
?>