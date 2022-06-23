<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>Login- Helpdesk System </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);

                }
            
            ?>
            <br><br>
            <!-- login form starts here- -->
            <form action="" method="POST" class="text-center">
             Username: <br>
             <input type="text" name="username" placeholder="Enter Username">
            <br><br>
             Password: <br>
             <input type="password" name="password" placeholder="Enter Password">
             <br><br>
             <input type="submit" name="submit" value="Login" class="btn-primary">  
            <br><br>
            </form>
            <!-- login form ends here- -->



            <p class="text-center">Created By-<a href="">Aniket</a></p>
        </div>
    </body>
</html>
<?php
        //check whether the Submit button is clicked or NOT
        if(isset($_POST['submit']))
        {
            //process for login
            //1. get the Data from login form
            $username=mysqli_real_escape_string($conn,$_POST['username']);
            $raw_password=md5($_POST['password']) ;
            $password=mysqli_real_escape_string($conn,$raw_password) ;

            //2. sql to check whether the user with username and password exists or not
            $sql="SELECT * FROM tbl_admin WHERE username= '$username' AND password='$password'";
            //3. Execute the query
            $res=mysqli_query($conn, $sql);
            // count rows to check whether user exists or not

            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //user Available and login success
                $_SESSION['login']= "<div class='success'> Login Successful.</div>";
                $_SESSION['user']= $username; //check if user logged in or not 
                //redirect to dash board
                header('location:'.SITEURL.'admin/');

            }
            else
            {
                //user not available and login fail
                $_SESSION['login']="<div class='error text-center'>Username or Password did not match</div>";
                header('location:'.SITEURL.'admin/login.php');
            }
        }
?>