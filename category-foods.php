<?php include('partials-front/menu.php');?>

<?php
    //check id passed or not 
    if(isset($_GET['category_id'])){
        //category id is set and get id
        $category_id=$_GET['category_id'];

        //get title based on id
        $sql="SELECT title from tbl_category where id=$category_id";

        //execute query
        $res=mysqli_query($conn,$sql);
        //get data

        $row=mysqli_fetch_assoc($res);

        //get title
        $category_title = $row['title'];
    }
    else{
         //category not found
         //rredirect
         header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //create sql for foods based on selected category
                $sql2="SELECT * from tbl_food where category_id=$category_id";

                //execute
                $res2=mysqli_query($conn,$sql2);
                //cunt
                $count2=mysqli_num_rows($res2);

                //check food available|not
                if($count2 > 0 ){
                    //food available
                    while($row2=mysqli_fetch_assoc($res2)){
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $price=$row2['price'];
                        $description=$row2['description'];
                        $image_name=$row2['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name==""){
                                            // img not available
                                            echo "<div class='error'>Image not available.</div>";
                                        }
                                        else{
                                            //img available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }

                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">Rs.<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else{
                    //not available
                    echo "<div class='error'>Food not available.</div>";
                }
            ?>

            <div class="clearfix"></div>

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>