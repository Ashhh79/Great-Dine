<?php 

    //inclued constants.php
    include('../config/constants.php'); 
    //1.get id of admin to be deleted
    $id=$_GET['id'];
    //2. create query to delete
    $sql="DELETE FROM tbl_admin where id=$id";
    //execute query

    $res=mysqli_query($conn,$sql);

    //check whether query worked or not

    if($res==TRUE){
        //echo "SUCCESS";
        //create session variable to display message
        $_SESSION['delete']="<div class='success'>ADMIN DELETED SUCCESSFULLY</div>";

        //redirect to manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        //echo "FAILED";
        //create session variable to display message
        $_SESSION['delete']="<div class='error'>ADMIN DELETION FAILED!</div>";

        //redirect to manage admin
        header('location:'.SITEURL.'admin/manage-admin.php');
    
    }

    //3. redirect to manage admin with message
    
?>