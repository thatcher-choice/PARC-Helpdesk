<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br><br>

        <?php
            //get id of selected admin
            $id=$_GET['id'];
            // create sql query ot get details
            $sql= "SELECT * FROM tbl_admin WHERE id=$id";
            //Execute the query
            $res=mysqli_query($conn,$sql);
            //check if query executed
            if($res==true)
            {
                //check if data available
                $count=mysqli_num_rows($res);
                //check if we have admin data or not
                if($count==1)
                {
                    //get details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    $full_name=$row['full_name'];
                    $username=$row['username'];

                }
                else{
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
    
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"> 

                    </td>
                </tr>
               
            </table>
    </div>
</div>

<?php
    //check if submit button clicked or not
    if(isset($_POST['submit']))
    {
       //echo "Button Clicked";
        //get all the values from form to update
         $id=$_POST['id'];
         $full_name =$_POST['full_name'];
         $username =$_POST['username'];
         
         //create sql qurey to update admin
         $sql="UPDATE tbl_admin SET
         full_name='$full_name',
         username='$username'
         WHERE id= '$id'
         ";

         //Execute query
         $res=mysqli_query($conn, $sql);

         //check whether the query executed successfully or not
         if($res==true)
         {
             //Query Executed and Admin updated
             $_SESSION['update']="<div class='success'>Admin Updated Successfully.</div>";
             //Redirect to Manage Admin Page
             header('location'.SITEURL.'admin/manage-admin.php');
         }
         else{
             $_SESSION['update']="<div class='error'> Error</div>";
              header('location'.SITEURL.'admin/manage-admin.php');
         }
    }
?>

<?php include('partials/footer.php'); ?>
