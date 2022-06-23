<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Cart</h1>
        <br><br>
        
        <?php
            //get id of selected category
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                // create sql query ot get details
                $sql2= "SELECT * FROM tbl_cart WHERE id=$id";
                //Execute the query

                $res2=mysqli_query($conn,$sql2);
                //check if query executed                   
                //check if data available
                if($res2==true)
                {
                $count=mysqli_num_rows($res2);
                //check if we have admin data or not
                if($count==1)
                {
                    //get details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res2);
                    $id=$row['id'];
                    
                    $scheme = $row['scheme'];
                    
                    $ctzn_age=$row['ctzn_age'];
                    
                    $query_date = $row['query_date'];
                    $query_status = $row['query_status'];
                    $ctzn_name = $row['ctzn_name'];
                    $contact_no = $row['contact_no'];
                    $email = $row['email'];
                    $ctzn_address = $row['ctzn_address'];
                    $ctzn_gender=$row['ctzn_gender'];
                    $employment_status=$row['employment_status'];
                

                }
                else
                {
                    $_SESSION['no-category-found']="<div class='error'>Citizen Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-cart.php');
                }
            }
            }

            else
            {
                    //redirect to manage scheme page
                    header('location:'.SITEURL.'admin/manage-cart.php');
            }
            
            
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="ctzn_name" value="<?php echo $ctzn_name;?>" ></td>
                </tr>

                
                <tr>
                    <td>Contact.no</td>
                    <td><input type="tel" name="contact_no" value="<?php echo $contact_no;?>" ></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $email;?>"  ></td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td><textarea name="ctzn_address" rows="10" value="<?php echo $ctzn_address;?>"></textarea> </td> 
                </tr>
                <tr>
                    <td>Scheme:</td>
                    <td><input type="text" name="scheme" value="<?php echo $scheme;?>"  ></td>
                </tr>
                <tr>
                    <td>Gender:</td>
                    <td>
                        <input  type="radio" name="gender" value="Male"> Male
                        <input  type="radio" name="gender" value="Female"> Female
                        <input  type="radio" name="gender" value="other"> Other
                    </td>
                </tr>

                <tr>
                    <td>Age:</td>
                    <td><input type="text" name="age" value="<?php echo $ctzn_age;?>" ></td>
                </tr>


                <tr>
                    <td>Employment Status:</td>
                    <td><input type="text" name="employment_status" value="<?php echo $employment_status;?>" ></td>
                </tr>
                
                <tr>
                    <td>Query Status:</td>
                    <td><input type="text" name="query_status" value="<?php echo $query_status;?>" ></td>
                </tr>
                



                <tr>
                    <td colspan="2">
                    
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Cart" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php
    //check if submit button clicked or not
    if(isset($_POST['submit']))
    {
       //echo "Button Clicked";
        //get all the values from form to update
        $scheme = $_POST['scheme'];

        $query_date = date("Y-m-d h:i:sa"); //Order DAte

        $query_status = $_POST['query_status'];  // Ordered, in progress, Answered, Cancelled

        $ctzn_name = $_POST['ctzn_name'];
        $contact_no = $_POST['contact_no'];
        $email = $_POST['email'];
        $ctzn_address = $_POST['ctzn_address'];
        if(isset($_POST['gender']))
        {
            $ctzn_gender=$_POST['gender'];
        }
        else
        {
            $ctzn_gender="Male";
        }
        
        $ctzn_age=$_POST['age'];

        if(isset($_POST['emp_status']))
        {
            $employment_status=$_POST['employment_status'];
        }
        else
        {
            $employment_status="Employed";
        }
         
         
         //create sql qurey to update admin
         $sql3="UPDATE tbl_cart SET
            scheme = '$scheme',
            
            email='$email',
            
            query_date = '$query_date',
            query_status = '$query_status',
            ctzn_name = '$ctzn_name',
            ctzn_gender = '$ctzn_gender',
            ctzn_age = '$ctzn_age',
            ctzn_address = '$ctzn_address',
            contact_no='$contact_no',
            employment_status='$employment_status'
         WHERE id= '$id'
         ";

         //Execute query
         $res3=mysqli_query($conn, $sql3);

         //check whether the query executed successfully or not
         if($res3==true)
         {
             //Query Executed and Admin updated
             $_SESSION['update']="<div class='success'>Cart Updated Successfully.</div>";
             //Redirect to Manage Admin Page
             header('location:'.SITEURL.'admin/manage-cart.php');
         }
         else{
             $_SESSION['update']="<div class='error'> Failed to Update</div>";
              header('location:'.SITEURL.'admin/manage-cart.php');
         }
    }
?>

<?php
    include('partials/footer.php');
?>