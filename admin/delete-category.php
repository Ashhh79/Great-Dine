<?php

    //inclue constants.php for siteurl
    include('../config/constants.php');
    
    //check whether id and imagename value set or nt
    if(isset($_GET['id'])AND  isset($_GET['image_name'])){
        //get value and delete
        //echo "gtcg";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //remove physical image file if available
        if($image_name!=""){
            //image available .so remote it
            $path="../images/category/".$image_name;
            //remove image
            $remove=unlink($path);

            if($remove==false){
                //add error message
                //session message
                $_SESSION['remove']="<div class='error'>Failed to remove Category Image</div>";
                //redirect manage-category
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop process
                die();
            }
        }

        //delete data from database
        $sql="DELETE from tbl_category where id=$id";
        //execte query
        $res=mysqli_query($conn,$sql);

        //check success of delete
        if($res==TRUE){
            //set success
            $_SESSION['delete']="<div class='success'>Removed Category Image</div>";
                //redirect manage-category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            //set failed message
            $_SESSION['delete']="<div class='error'>Failed to delete Category</div>";
                //redirect manage-category
                header('location:'.SITEURL.'admin/manage-category.php');
        }

        //redirect to manage category
    }
    else{
        //redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>