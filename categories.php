<?php include('partials-front/menu.php');?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //display alll categories that are active
                //sql 
                $sql="SELECT * from tbl_category where active='Yes'";
                //execute query
                $res=mysqli_query($conn,$sql);
                // count
                $count=mysqli_num_rows($res);

                //check category available or not
                if($count>0){
                    //available
                    while($row=mysqli_fetch_assoc($res)){
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name==""){
                                        //image not available
                                        echo "<div class='error'>Image not found.</div>";

                                    }
                                    else{
                                        //img available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                            </a>
                        <?php
                    }
                }
                else{
                    //not available
                    echo "<div class='error'>Categories not found.</div>";
                }
            
            ?>
            

            

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>