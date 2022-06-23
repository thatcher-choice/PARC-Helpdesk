<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['add'])) //if session is assigned add
                {
                    echo $_SESSION['add']; // printing session message
                    unset($_SESSION['add']); //removing session message
                }
                
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" name="full_name" placeholder="Enter Your Name" ></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Your Userename">
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" placeholder="Your Password"></td>
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

<?php include('partials/footer.php'); ?>

<?php
   //process the value from form and save it in database 
    // check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1.get data from form
        $full_name =$_POST['full_name'];
        $username= $_POST['username'];
        $password=md5($_POST['password']); //one way password encryption with md5

        //2.sql query to save data into databaase
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
        //echo $sql;

        //3. Execute Query and save data in database
        $res=mysqli_query($conn,$sql) or die(mysqli_error());

        //4.Check wether the(Query is Executed) data is inserted or not and diplay appropriate message
        if($res==TRUE)
        {
            // Data Inserted
            //echo "Data inserted";
            //create a session variable to display message
            $_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
            //Redirect page manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else{
            //echo "Failed to insert the data";
            //create a session variable to display message
            $_SESSION['add']="<div class='error'>Failed to Add Admin</div>";
            //Redirect page Add admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
?>