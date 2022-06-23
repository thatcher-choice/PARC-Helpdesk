<?php
    //authorization
    //check if user logged in or not
    if(!isset($_SESSION['user']))
    {
        //user not logged in
        //redirect to login page
        $_SESSION['no-login-message']= "<div class= 'error text-center'>Please login to access Admin Panel</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
?>