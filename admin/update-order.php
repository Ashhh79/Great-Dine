<?php include('partials/menu.php'); ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update order</h1>
            <br><br>

            <?php  
                //checkk id set or not
                if(isset($_GET['id'])){
                    //order details
                    $id=$_GET['id'];

                    $sql="SELECT * from tbl_order where id=$id";

                    //execute
                    $res=mysqli_query($conn,$sql);

                    $count=mysqli_num_rows($res);

                    if($count==1){
                        //get details
                        $row=mysqli_fetch_assoc($res);

                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['quantity'];
                        $status=$row['status'];
                        $customer_name=$row['customer_name'];
                        $customer_contact=$row['customer_contact'];
                        $customer_email=$row['customer_email'];
                        $customer_address=$row['customer_address'];

                    }
                    else{
                        //details not available
                        //redirect 
                        header('location:'.SITEURL.'admin/manage-order.php');
                    }
                }
                else{
                    //redirect
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            ?>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Food Name</td>
                        <td><b><?php echo $food; ?></b></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            <b>Rs. <?php echo $price; ?></b>
                        </td>
                    </tr>
                    <tr>
                        <td>QTY</td>
                        <td><input type="number" name="qty" value="<?php echo $qty; ?>" id=""></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status" id="">
                                <option <?php if($status=='Ordered'){echo "selected";} ?> value="Ordered">Ordered</option>
                                <option <?php if($status=='On Delivery'){echo "selected";} ?> value="On Delivery">On Delivery</option>
                                <option <?php if($status=='Delivered'){echo "selected";} ?> value="Delivered">Delivered</option>
                                <option <?php if($status=='Cancelled'){echo "selected";} ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer name</td>
                        <td>
                            <input type="text" name="customer_name" value="<?php echo $customer_name; ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Contact</td>
                        <td>
                            <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer email</td>
                        <td>
                            <input type="text" name="customer_email" value="<?php echo $customer_email; ?>" id="">
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td>
                            <textarea name="customer_address" id="" cols="30" rows="4">
                                <?php echo $customer_address; ?>
                            </textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" value="Update Order" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php 
                if(isset($_POST['submit'])){
                    //get data
                    $id=$_POST['id'];
                    $price=mysqli_real_escape_string($conn,$_POST['price']);
                    $qty=mysqli_real_escape_string($conn,$_POST['qty']);

                    $total=$price * $qty;

                    $status=mysqli_real_escape_string($conn,$_POST['status']);

                    $customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
                    $customer_contact=mysqli_real_escape_string($conn,$_POST['customer_contact']);
                    $customer_email=mysqli_real_escape_string($conn,$_POST['customer_email']);
                    $customer_address=mysqli_real_escape_string($conn,$_POST['customer_address']);

                    $sql2="UPDATE tbl_order SET 
                        quantity=$qty,
                        total=$total,
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                        where id = $id
                    ";
                    //echo $sql2;
                    $res2=mysqli_query($conn,$sql2);

                if($res2==TRUE){
                    $_SESSION['update']="<div class='success'>Order Updated..</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else{
                    $_SESSION['update']="<div class='error'>Failed to Update..</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }


                }
            ?>
        </div>
    </div>
<?php include('partials/footer.php'); ?>