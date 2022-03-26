<?php
    include('../config/constants.php'); 



    if(isset($_GET['id'])&& isset($_GET['image_name'])){
        //process deletion

        //1.getid ,imgname
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        
        //2. remove img if available
        //check if available then delete
        if($image_name!=""){
            $path="../images/food/".$image_name;
            //remove image
            $remove=unlink($path);

            if($remove==false){
                //add error message
                //session message
                $_SESSION['upload']="<div class='error'>Failed to remove Food Image</div>";
                //redirect manage-category
                header('location:'.SITEURL.'admin/manage-food.php');

                //stop process
                die();
            }
        }
        //3. delete from database
        //sql query
        $sql="DELETE from tbl_food where id=$id";
        //execte query
        $res=mysqli_query($conn,$sql);

        //check success of delete
        if($res==TRUE){
            //set success
            $_SESSION['delete']="<div class='success'>Food category deleted</div>";
                //redirect manage-category
            header('location:'.SITEURL.'admin/manage-food.php');
        }
        else{
            //set failed message
            $_SESSION['delete']="<div class='error'>Failed to delete food catrgory</div>";
                //redirect manage-category
                header('location:'.SITEURL.'admin/manage-food.php');
        }

    }
    else{
        //redirect
        //redirect to manage food
        $_SESSION['unauthorize']="<div class='error'>Unauthorised access!!!</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>