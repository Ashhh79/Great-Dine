<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Categories</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

        <!-- Add Category form starts-->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td><input type="text" name="title" plceholder="Category title"></td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            //1.to check btn clicked or not
            if(isset($_POST['submit'])){
                //echo "clicked";
                //2. get value from form
                $title=mysqli_real_escape_string($conn,$_POST['title']);

                //for radio button we need to check whether it s clicked or not
                if(isset($_POST['featured'])){
                    $featured=mysqli_real_escape_string($conn,$_POST['featured']);
                }
                else{
                    //set default 
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    $active=mysqli_real_escape_string($conn,$_POST['active']);
                }
                else{
                    //set default 
                    $active="No";
                }

                //check whether image selected and set image name accordingly
                //print_r($_FILES['image']);
                //die();//break code here
                if(isset($_FILES['image']['name'])){
                    //upload image
                    //to upload image we need image name,source path and destination
                    $image_name=$_FILES['image']['name'];

                    //upload image only if image is selected
                    if($image_name!=""){

                    

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
                            header("location:".SITEURL.'admin/add-category.php');

                            //Stop process
                            die();
                        }
                    }
                }
                else{
                    //don't upload image and set value as blank
                    $image_name="";
                }

                //3. Create sql query
                $sql="INSERT into tbl_category set
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //4. execute query
                $res=mysqli_query($conn,$sql);
                
                //5. check execution
                if($res==TRUE){
                    //query success
                    $_SESSION['add']="<div class='success'>Category added successfully</div>";
                    //redirect page
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else{
                    //echo "FAiled";
                    //seesion variable to display message
                    $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
                    //redirect page
                    header("location:".SITEURL.'admin/add-category.php');
                }
                
                
            }
        ?>



        <!--Add category ends-->
    </div>
</div>










<?php include('partials/footer.php'); ?>