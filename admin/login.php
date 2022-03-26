<?php include('../config/constants.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body class="login-back" >
    
    <div class="login">
    
        <h1 class="text-center">Login</h1><br><br>
        
        <?php 
            if(isset($_SESSION['login'])){
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message'])){
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>

        <br><br><br><br><br>
        
        
        
        <!--login starts here-->
        <form action="" method="post" class="text-center">
            <h5>Username: </h5><br>
            <input type="text" name="username" placeholder="Enter Username" class="textbox i"><br><br>
            <h5>Password:  </h5><br>
            <input type="password" name="password" placeholder="Enter Password" class="textbox i"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary btn"><br><br>
        </form>
        <!--login ends here-->
        <p class="text-center footer-style">Created by - <a href="https://www.instagram.com/___ashhh____79/">Akash Kushwaha</a></p><br><br>
    </div>
</body>
</html>

<?php 
//button clicked
    if(isset($_POST['submit'])){
        //process login
        //1.gte dta
        //$username=$_POST['username'];
        //$password=md5($_POST['password']);
        $username=mysqli_real_escape_string($conn,$_POST['username']);
        $raw_password=md5($_POST['password']);
        $password=mysqli_real_escape_string($conn,$raw_password);

        //2. sql to check whether username or password exists
        $sql="SELECT * FROM tbl_admin where username='$username' and password='$password'";
        
        //3. exwcute  query
        $res=mysqli_query($conn,$sql);

        //4.
        $count=mysqli_num_rows($res);

        if($count==1){
            //user availabe
            $_SESSION['login']="<div class='success'>Login Success</div>";
            $_SESSION['user']=$username;//to check whether user is logged in or not
            
            //redirect home page
            header("location:".SITEURL.'admin/');
        }
        else{
            //user not available
            $_SESSION['login']="<div class='error text-center'>Username or password does not match</div>";
            //redirect home page
            header("location:".SITEURL.'admin/login.php');
        
        }
    }
?>