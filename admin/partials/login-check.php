<?php
    //check whether user is logged in or not
    //Authorization or acess control
    if(!isset($_SESSION['user'])){
        //if user session not set
        //redirecto login page
        $_SESSION['no-login-message']="<div class='error text-center'>Please login to access admin</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>