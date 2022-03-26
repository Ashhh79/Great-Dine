<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>UPDATE ADMIN</h1>

        <br><br>
        <?php 
            //inclued constants.php
             
            //1.get id of admin to be updated
            $id=$_GET['id'];

            //2. create query to delete
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            //execute query

            $res=mysqli_query($conn,$sql);
            //check whether query worked or not

            if($res==TRUE){
                //echo "SUCCESS";
                $count=mysqli_num_rows($res);
                //check whether admin data present
                if($count==1){
                    //get Details 
                    //echo "Admin avaailable";
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['username'];
                }
                else{
                   //redirect to manage admin page
                   header('location'.SITEURL.'admin/manage-admin.php'); 
                }
               

               
            }
            
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
    //check button clicked or not
    if(isset($_POST['submit'])){
        //echo "clicked";
        //get values from form
        $id=$_POST['id'];
        $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);

        //sql query
        $sql="UPDATE tbl_admin SET 
        full_name='$full_name',
        username='$username' 
        WHERE id='$id'
        ";

        //execute query
        $res=mysqli_query($conn,$sql);

        //check success or not
        if($res==TRUE){
            //success
            $_SESSION['update']="<div class='success'>SUCCESS updation</div>";
            //redirect to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else{
            //failed
            $_SESSION['update']="<div class='error'>FAILED updation</div>";
            //redirect to manage admin
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php');?>