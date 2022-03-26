<?php include('partials-front/menu.php');?>

<?php
    //check food id set or not
    if(isset($_GET['food_id'])){
        ////gett if and details of selected food
        $food_id=$_GET['food_id'];

        //get details 
        $sql="SELECT * from tbl_food where id=$food_id";

        //execute
        $res=mysqli_query($conn,$sql);

        //count
        $count=mysqli_num_rows($res);

        //check data avaialablity
        if($count==1){
            //get details
            $row=mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            $image_name=$row['image_name'];
        }
        else{
            //redirect
            //food not available
            header('location:'.SITEURL);
        }
    }
    else{
        //redirect
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name==""){
                                //img not available
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
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">Rs.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Akash Kushwaha" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. user123@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            <?php
                if(isset($_POST['submit'])){
                    //echo "clicked";

                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];
                    $total=$price * $qty;
                    $order_date=date("Y-m-d h:i:sa");//order date/time
                    $status="Ordered";//ordered ,on delievery,deleivered, cancellec;

                    $customer_name=$_POST['full_name'];

                    $customer_contact=$_POST['contact'];
                    $customer_email=$_POST['email'];

                    $customer_address=$_POST['address'];

                    //save order in database

                    $sql2="INSERT into tbl_order SET 
                        food='$food',
                        price=$price,
                        quantity=$qty,
                        total=$total,
                        order_date='$order_date',
                        status ='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'

                    ";
                   // echo $sql2;
                    //execute query
                    $res2=mysqli_query($conn,$sql2);

                    //check executed or not
                    if($res2==TRUE){
                        //query executed and order saved
                        $_SESSION['order']="<div class='success text-center'>Order Placed Successfully!!</div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order']="<div class='error text-center'>Failed to place Order!</div>";
                        header('location:'.SITEURL);
                    }
                }
                
            ?>


        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>