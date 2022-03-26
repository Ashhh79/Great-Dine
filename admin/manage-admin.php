<?php include('partials/menu.php');?>

        <!--Main Content-->
        <div class="Main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//dis[laying session message]
                        unset($_SESSION['add']);//removing session message
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];//displaying session message
                        unset($_SESSION['delete']);//removing session message
                    }
                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];//displaying session message
                        unset($_SESSION['update']);//removing session message
                    }
                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];//displaying session message
                        unset($_SESSION['user-not-found']);//removing session message
                    
                    }
                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];//displaying session message
                        unset($_SESSION['pwd-not-match']);//removing session message
                    
                    }
                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];//displaying session message
                        unset($_SESSION['change-pwd']);//removing session message
                    
                    }
                ?>

                <br><br>

                <!--Button to Add Admin-->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>SR No.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                    <?php 
                    //query to get all admins 
                        $sql="SELECT * FROM tbl_admin";
                        //execute query
                        $res=mysqli_query($conn,$sql);

                        //check query executed or not
                        if($res==TRUE){
                            //count rows to check data present or not
                            $count=mysqli_num_rows($res);//function to get al thr rows
                            $sn=1;//create a variable and assign the value 

                            //check no of rows
                            if($count>0){
                                while($rows=mysqli_fetch_assoc($res)){
                                    //using while loop to get data 
                                    //get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //display values in our table
                                    ?>

                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name ;?> </td>
                                    <td><?php echo $username ;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php
                                }
                            }
                        }
                    ?>
                    
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <!--Main Ends-->

<?php include('partials/footer.php'); ?>