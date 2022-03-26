<?php include('partials/menu.php');?>
    <div class="main-content">
        <div class="wrapper">
            <h1>Add Food</h1>
            <br><br>

            <?php
                if(isset($_SESSION['upload'])){
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
            ?>
            <form action="" method="post" enctype="multipart/form-data"> 
                <table class="tbl-30">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Enter Title of Food">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="description of food..."></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image</td>
                        <td>
                            <input type="file" name="image" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Category:</td>
                        <td><select name="category" id="">
                            <?php
                                //code to display categories from database
                                //sql to get all active categories
                                $sql="SELECT * from tbl_category where active='Yes'";

                                $res=mysqli_query($conn,$sql);
                                //count no of rows
                                $count=mysqli_num_rows($res);

                                //if count>0 we have categories
                                if($count>0){
                                    //we have category
                                    while($row=mysqli_fetch_assoc($res)){
                                        //get details of category
                                        $id=$row['id'];
                                        $title=$row['title'];

                                        ?>
                                        <option value="<?php echo $id;?>"><?php echo $title;?></option>
                                        <?php
                                    }
                                }
                                else{
                                    //no category avilable
                                    ?>
                                    <option value="0">No categories Found</option>
                                    <?php
                                }
                                
                                //display on dropdown
                            ?>


                            
                        </select></td>
                    </tr>
                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" id="" value="Yes"> Yes
                            <input type="radio" name="featured" id="" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" id="" value="Yes"> Yes
                            <input type="radio" name="active" id="" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Add Food" name="submit" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
            <?php
            //check button clicked or not
                if(isset($_POST['submit'])){
                    //echo "Clicked";
                    //1.get data
                    $title=mysqli_real_escape_string($conn,$_POST['title']);
                    $description=mysqli_real_escape_string($conn,$_POST['description']);
                    $price=mysqli_real_escape_string($conn,$_POST['price']);
                    $category=mysqli_real_escape_string($conn,$_POST['category']);
                    //check whether radio button are clicked or not
                    if(isset($_POST['featured'])){
                        $featured=mysqli_real_escape_string($conn,$_POST['featured']);
                    }
                    else{
                        $featured="No";
                    }
                    //active radio button
                    if(isset($_POST['active'])){
                        $active=mysqli_real_escape_string($conn,$_POST['active']);
                    }
                    else{
                        $active="No";
                    }
                    

                    //2.upload img if selected
                    //check img iis selected or not and upload if selected
                    if(isset($_FILES['image']['name'])){
                        //get details
                        $image_name=$_FILES['image']['name'];
                        //check img is selected or not
                        if($image_name!=""){
                            //img selected
                            //A. rename img
                            //Auto rename our image
                            //get extension of our image
                            $ext=end(explode('.',$image_name));

                            //rename mage
                            $image_name="Food-Name-".rand(0000,3999).'.'.$ext; //e.g. Food_Category_807.$ext
                            
                            //source path is current imag location
                            $source_path=$_FILES['image']['tmp_name'];
                            //destinamtion for img
                            $destination_path="../images/food/".$image_name;

                            //finally upload
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //check whether image is uploaded or not
                            //and if image is not uploaded then we will stop process and redirect with error message
                            if($upload==false){
                                //set message
                                $_SESSION['upload']="<div class='error'>Failed to upload Image</div>";
                                //redirect page
                                header("location:".SITEURL.'admin/add-food.php');

                                //Stop process
                                die();
                            }
                        }
                    }
                    else{
                        //default value
                        $image_name="";
                    }
                    //3.insert into database
                    //sql query 
                    $sql2="INSERT into tbl_food SET
                        title='$title',
                        description='$description',
                        price=$price,
                        image_name='$image_name',
                        category_id=$category,
                        featured='$featured',
                        active='$active'
                    ";
                    //execute query
                    $res2=mysqli_query($conn,$sql2);

                    //check data inserted or not
                    if($res2==True){
                        //data inserted
                        //query success
                        $_SESSION['add']="<div class='success'>Food added successfully</div>";
                        //redirect page
                        header("location:".SITEURL.'admin/manage-food.php');
                    }
                    else{
                        //failed to insert
                        //seesion variable to display message
                        $_SESSION['add']="<div class='error'>Failed to Add Food</div>";
                        //redirect page
                        header("location:".SITEURL.'admin/add-food.php');
                    }
                 
                }
                
            ?>
        </div>
    </div>




<?php include('partials/footer.php');?>