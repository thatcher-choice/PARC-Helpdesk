<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST" >

        <table class="tbl-30">
            <tr>
                <td>Current Password:</td>
                <td>
                    <input type="password" name="current_password" placeholder="Current Password">
                </td>
            </tr>

            <tr>
                <td>New Password:</td>
                <td>
                    <input type="password" name="new_password" placeholder="New Password">
                </td>
            </tr>
            <tr>
                <td>Confirm Password:</td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
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
        //check if the Submit Button is clicked or not
        if(isset($_POST['submit']))
        {
            echo "clicked";
            //1. Get data from form
            $id=$_POST['id'];
            $current_password=md5($_POST['current_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);

            //2. check the user with current id and password exists or not
            $sql= "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
            $res=mysqli_query($conn, $sql);
            

            if($res==true)
            {
                //check if data available or not
                $count=mysqli_num_rows($res);
                //echo $count;
                if($count==1)
                {
                    //echo "User Found";

                    if($new_password==$confirm_password)
                    {
                        //update the password
                        //echo "Password Match";
                        $sql2="UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                        ";
                        //Execute
                        $res2 =mysqli_query($conn, $sql2);
                        //check if executed
                        if($res2==true)
                        {
                            //display succes message
                            //redirect with success message
                            $_SESSION['change-pwd']="<div class='success'> Password changed successfully </div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                            
                        }
                        else{
                            //Display Error Message
                            //redirect with error message
                            $_SESSION['change-pwd']="<div class='error'> Failed to change password </div>";
                            //redirect the user
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    }
                    else
                    {
                        $_SESSION['pwd-not-match']="<div class='error'> Password did not match </div>";
                        //redirect the user
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else{
                    $_SESSION['user-not-found']="<div class='error'> User not found </div>";
                    //redirect the user
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            //3. Check if new password and confirm password match or not
            //4. Change password if all above is true
        }
?>

 <?php include('partials/footer.php'); ?>