<?php include('partials/menu.php');?>

<?php
    //check id selected pr not
    if(isset($_GET['id'])){
        //get details
        $id=$_GET['id'];
        //sql query
        $sql2="SELECT * from tbl_food where id=$id";

        //exeute query
        $res2=mysqli_query($conn,$sql2);

        //get value based on query
        $row2=mysqli_fetch_assoc($res2);
        //get individual value

        $title=$row2['title'];
        $description=$row2['description'];
        $price=$row2['price'];
        $current_image=$row2['image_name'];
        $current_category=$row2['category_id'];
        $featured=$row2['featured'];
        $active=$row2['active'];

    }
    else{
        //redirect
        header('location:'.SITEURL.'admin/manage-food.php');
    }

?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl_30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>

                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="4"><?php echo $description;?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" id="" value="<?php echo $price;?>">
                    </td>

                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php 
                            if($current_image==""){
                                //img not available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else{
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image; ?>" alt="" width="100px">

                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">
                            <?php
                            //query to get active foods
                                $sql="SELECT * from tbl_category Where active='Yes'";

                                //execute query
                                $res=mysqli_query($conn,$sql);
                                //count num of rows 
                                $count=mysqli_num_rows($res);

                                //check category available or not
                                if($count>0){
                                    //category available
                                    while($row=mysqli_fetch_assoc($res)){
                                        //get title and id
                                        $category_title=$row['title'];
                                        $category_id=$row['id'];

                                        //echo "<option value='$category_id'>$category_title</option>";
                                        ?>
                                            <option <?php if($current_category==$category_id){echo "Selected";} ?> value="<?php echo $category_id;?>"><?php echo $category_title;?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //not available
                                    echo "<option value='0'>Category not available</option>";
                                }

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" id="" value="Yes">Yes
                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" id="" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" id="" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" value="Update Food" name="submit" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
        <?php
            if(isset($_POST['submit'])){
                //echo clicked
                //1.get all details
                $id=$_POST['id'];
                $title=mysqli_real_escape_string($conn,$_POST['title']);
                $description=mysqli_real_escape_string($conn,$_POST['description']);
                $price=mysqli_real_escape_string($conn,$_POST['price']);
                $current_image=mysqli_real_escape_string($conn,$_POST['current_image']);
                $category=mysqli_real_escape_string($conn,$_POST['category']);
                $featured=mysqli_real_escape_string($conn,$_POST['featured']);
                $active=mysqli_real_escape_string($conn,$_POST['active']);

                //2. upload img if selected

                //check whether img is selected
                if(isset($_FILES['image']['name'])){
                    //upload button clicked
                    $image_name=$_FILES['image']['name'];//New img name
                    //check whether file availble or not
                    if($image_name!=""){
                        //img available

                        //A. updating new img
                        //
                        $ext = end(explode('.',$image_name));//get extension 
                        $image_name="Food_Name_".rand(0000,9999).'.'.$ext;//renaming done here

                        //get source and destination
                        $source_path=$_FILES['image']['tmp_name'];
                        $dst_path="../images/food/".$image_name;

                        //upload img
                        $upload=move_uploaded_file($source_path,$dst_path);

                        //check img uploaded or not
                        if($upload==false){
                            //failed to upload img
                            $_SESSION['upload']="<div class='error'>Failed to upload New Image..</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            //stop process
                            die();
                        }
                         //3. remov img
                        //B. Remove image if available
                        if($current_image!=""){
                            //current_img is available
                            //remove img
                            $remove_path="../images/food/".$current_image;
                            $remove=unlink($remove_path);
                            //check img removed or not
                            if($remove==false){
                                //failed to remove current  img
                                $_SESSION['remove-failed']="<div class='error'>Failed to current Image</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                //stop process
                                die();
                                
                            }
                        }

                    }
                    else{
                        $image_name=$current_image;//default img when img is not selected

                    }
                }
                else{
                    $image_name=$current_image;//default img when btn is not clicked
                    
                }

               

                //4.update food in database
                $sql3="UPDATE tbl_food Set
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category,
                    featured='$featured',
                    active='$active'
                    where id=$id
                ";

                //execute query
                $res3=mysqli_query($conn,$sql3);

                //check query executed or not
                if($res3==TRUE){
                    //query success
                    $_SESSION['food-update']="<div class='success'>Food Updated</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                else{
                    //query failed
                    $_SESSION['food-update']="<div class='error'>Food Update Failed...</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }

                //redirect
                
            }
        ?>
    </div>
</div>

    
<?php include('partials/footer.php');?>