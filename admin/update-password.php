<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        ?>



        <form action="" method="post">
            <table class="tbl_30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">

                    </td>
                </tr>
                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                        
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td>
                    <input type="password" name="confirm_password" placeholder="Confirm password">
                    </td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
    //Check whether submit button is clicked
    if(isset($_POST['submit'])){
        //echo "clicked";

        //1. Get DAta from FORM
        $id=$_POST['id'];
        $current_password=md5($_POST['current_password']);
        $new_password=md5($_POST['new_password']);
        $confirm_password=md5($_POST['confirm_password']);
        //2. Check whether the user with current id &password exists or not

        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

        //execute query

        $res=mysqli_query($conn,$sql);

        if($res==TRUE){
            //check data availability
            $count=mysqli_num_rows($res);

            if($count==1){
                //user 
                //echo "user found";
                if($new_password==$confirm_password){
                    //update password
                    $sql2="UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id";

                    //execute query
                    $res2=mysqli_query($conn,$sql2);

                    //check xecution
                    if($res2==TRUE){
                        $_SESSION['change-pwd']="<div class='success'>Password Changed Success</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else{
                        $_SESSION['change-pwd']="<div class='error'>Password Changed Failed</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    //redirect to manage admin with error mesage
                    $_SESSION['pwd-not-match']="<div class='error'>Password did not match!!</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
                //check new and confirm matches or not
            }
            else{
                //donot exists and redirect
                $_SESSION['user-not-found']="<div class='error'>User not Found!!</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }

        //3. Check whether new password & confirm password match or not

        //4. change password if all above is true
    }
?>


<?php include('partials/footer.php');?>