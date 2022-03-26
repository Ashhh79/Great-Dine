<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <?php
            if(isset($_SESSION['add'])){//checking session is set or not 
                echo $_SESSION['add'];//display session message when set
                unset($_SESSION['add']);//removing message
            } 
        ?>

        <br><br>
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" placeholder="Enter Name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="username" placeholder="Enter Username"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="Enter password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                </td>
            </tr>
        </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php');?>


<?php
    //process the value from form and save in database
    //check whether submit button is clicked or not
    if(isset($_POST['submit'])){
        //button clicked
        //echo "Button clicked";

        //1. get data from form
        $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $password=mysqli_real_escape_string(md5($conn,$_POST['password']));//password encryption with md5


        //2. SQL query to save data in database
        $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',  
        username='$username',
        password='$password'
        ";  //left database column name and right variable name
        
        
        //3. Executing queryand saving data
        $res=mysqli_query($conn,$sql) or die(mysqli_error());

        //4. check whether data is inserted or not
        if($res==TRUE){
            //echo "DATA INSERTED";
            //seesion variable to display message
            $_SESSION['add']="<div class='success'>Admin added Successfully</div>";
            //redirect page
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //echo "FAiled";
            //seesion variable to display message
            $_SESSION['add']="<div class='error'>Failed to Insert</div>";
            //redirect page
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    
?>


