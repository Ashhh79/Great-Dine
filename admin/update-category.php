<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>


    <br><br>

    <?php 
        //check id set or not
        if(isset($_GET['id'])){
            //get details
            //echo "data recieved";
            $id=$_GET['id'];
            //sql to get all values
            $sql="SELECT * FROM tbl_category WHERE id=$id";

            //execute query
            $res=mysqli_query($conn,$sql);

            $count=mysqli_num_rows($res);

            if($count==1){
                //get data 
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                //redirect with session message
                $_SESSION['no-category-found']="<div class='error'>Category not Found</div>";
                //redirect
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        else{
            //redirect to manage category

            header('location:'.SITEURL.'admin/manage-category.php');
        }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">

                </td>
            </tr>
            <tr>
                <td>
                    Image display
                </td>
                <td>
                    <?php
                        if($current_image!=""){
                            //displayimage
                            ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    else{
                        echo "<div class='error'>Image not added!!</div>";
                    }

                    ?>
                </td>
                
            </tr>
            <tr>
                <td>New Image:</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" value="Update Category" name="submit" class="btn-secondary">
                </td>
            </tr>
        </table>

    </form>

    <?php 
        if(isset($_POST['submit'])){
            //echo "clicked";
            //1. get all values from form
            $id=$_POST['id'];
            $title=mysqli_real_escape_string($conn,$_POST['title']);
            $current_image=mysqli_real_escape_string($conn,$_POST['current_image']);
            $featured=mysqli_real_escape_string($conn,$_POST['featured']);
            $active=mysqli_real_escape_string($conn,$_POST['active']);

            //2.updating new image
            //check image selected or not
            if(isset($_FILES['image']['name'])){
                //get imagedetails
                $image_name=$_FILES['image']['name'];
                //check img available or not
                if($image_name!=""){
                    //available
                    //A. upload new immg
                    //Auto rename our image
                        //get extension of our image
                        $ext=end(explode('.',$image_name));

                        //rename mage
                        $image_name="Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_807.$ext
                        

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/category/".$image_name;

                        //finally upload
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check whether image is uploaded or not
                        //and if image is not uploaded then we will stop process and redirect with error message
                        if($upload==false){
                            //set message
                            $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                            //redirect page
                            header('location:'.SITEURL.'admin/manage-category.php');

                            //Stop process
                            die();
                        }
                    //B. remove current_image if available
                    if($current_image!=""){
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);

                        //check img removed or not
                        if($remove==false){
                            $_SESSION['failed-remove']="<div class='error'>Failed to remove current Image</div>";
                            //redirect page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    }
                    

                }
                else{
                    $image_name=$current_image;
                }

            }
            else{
                $image_name=$current_image;
            }

            //3. update database

            $sql2="UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                Where id=$id
            ";
            //4. exute query
            $res2=mysqli_query($conn,$sql2);
            
            //5. redirect
            // check executed or not
            if($res2==TRUE){
                //updated
                $_SESSION['update']="<div class='success'>Category updated</div>";
                //redirect
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //failed
                $_SESSION['update']="<div class='error'>Category not updated</div>";
                //redirect
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        }

    ?>
    </div>
</div>


<?php include('partials/footer.php');?>