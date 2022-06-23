
<?php include('partials-front/menu.php'); ?>

<?php 
    //CHeck whether scheme id is set or not
    if(isset($_GET['scheme_id']))
    {
        //Get the scheme id and details of the selected scheme
        $scheme_id = $_GET['scheme_id'];

        //Get the DEtails of the SElected scheme
        $sql = "SELECT * FROM tbl_schemes WHERE id=$scheme_id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);
        //Count the rows
        $count = mysqli_num_rows($res);
        //CHeck whether the data is available or not
        if($count==1)
        {
            //WE Have DAta
            //GEt the Data from Database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $government_department = $row['government_department'];
            $image_name = $row['image_name'];
            $for_what=$row['for_what'];
        }
        else
        {
            //scheme not Availabe
            //REdirect to Home Page
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Redirect to homepage
        header('location:'.SITEURL);
    }
?>

<!-- scheme sEARCH Section Starts Here -->
<section class="scheme-search">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your query.</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend  class="text-white">Selected scheme</legend>

                <div class="scheme-menu-img">
                    <?php 
                    
                        //CHeck whether the image is available or not
                        if($image_name=="")
                        {
                            //Image not Availabe
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image is Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/scheme/<?php echo $image_name; ?>" alt="img" class="img-responsive img-curve">
                            <?php
                        }
                    
                    ?>
                    
                </div>

                <div class="scheme-menu-desc">
                    <h3 class="text-white"><?php echo $title; ?></h3>
                    <input type="hidden" name="scheme" value="<?php echo $title; ?>">

                    <p class="scheme-department"><?php echo $government_department; ?></p>
                    <input type="hidden" name="department" value="<?php echo $government_department; ?>">

          
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend class="text-white">Citizen Details</legend>
                <div class="order-label text-white">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Aniket Jha" class="input-responsive" required>

                <div class="order-label text-white">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9568xxxxxx" class="input-responsive" required>

                <div class="order-label text-white">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@annijha.com" class="input-responsive" required>

                <div class="order-label text-white">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <div class="order-label text-white">Gender</div>
                <input class="text-white" type="radio" name="gender" value="Male"> Male
                <input class="text-white" type="radio" name="gender" value="Female"> Female
                <input class="text-white" type="radio" name="gender" value="other"> Other

                <div class="order-label text-white">Age</div>
                <input type="text" name="age" >

                <div class="order-label text-white">Employment Status</div>
                <input class="text-white" type="radio" name="emp_status" value="Employed"> Employed
                <input class="text-white" type="radio" name="emp_status" value="Unemployed"> Unemployed

                        <br>
                <input type="submit" name="submit" value="Confirm" class="btn btn-primary">
            </fieldset>

        </form>

        <?php 

            //CHeck whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // Get all the details from the form

                $scheme = $_POST['scheme'];
                
                

                

                $query_date = date("Y-m-d h:i:sa"); //Order DAte

                $status = "Asked";  // Ordered, in progress, Answered, Cancelled

                $ctzn_name = $_POST['full-name'];
                $contact_no = $_POST['contact'];
                $email = $_POST['email'];
                $address = $_POST['address'];
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
                    $employment_status=$_POST['emp_status'];
                }
                else
                {
                    $employment_status="Employed";
                }
                



                //Save the Order in Databaase
                //Create SQL to save the data
                $sql2 = "INSERT INTO tbl_cart SET 
                    scheme = '$scheme',
                    
                    email='$email',
                    
                    query_date = '$query_date',
                    query_status = '$status',
                    ctzn_name = '$ctzn_name',
                    ctzn_gender = '$ctzn_gender',
                    ctzn_age = '$ctzn_age',
                    ctzn_address = '$address',
                    contact_no='$contact_no',
                    employment_status='$employment_status'
                ";

                //echo $sql2; die();

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Check whether query executed successfully or not
                if($res2==true)
                {
                    //Query Executed and Order Saved
                    $_SESSION['order'] = "<div class='success text-center'>Query Added Successfully.</div>";
                    header('location:'.SITEURL);
                }
                else
                {
                    //Failed to Save Order
                    $_SESSION['order'] = "<div class='error text-center'>Failed to Add Query.</div>";
                    header('location:'.SITEURL);
                }

            }
        
        ?>

    </div>
</section>
<!-- scheme sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>