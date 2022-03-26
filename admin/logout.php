<?php

//include constants for siteurl
include('../config/constants.php');
//1. Destroy session
session_destroy();//unsets $_SESSION['user']
//2.redirect
header('location:'.SITEURL.'admin/login.php');

?>