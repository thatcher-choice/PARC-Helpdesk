<?php include('partials/menu.php'); ?>

<div class= "main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!--Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td> Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">

                    </td>
                </tr>

            </table>
        </form>
        <!--Add category form ends -->

        <?php
            //check if submit button pressed or not
            if(isset($_POST['submit']))
            {
                //echo "clicked";
                //get value from form
                $title=$_POST['title'];
                //for radio input type to check if button selected or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";
                }
                if(isset($_POST['active']))
                {
                    //Get the value from form
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }
                //check if image is selected or not and set value for image name
                //print_r($_FILES['image']);
                //die();
                if(isset($_FILES['image']['name']))
                {
                    //upload
                    //to do so we need source and destination path
                    $image_name=$_FILES['image']['name'];
                    //upload image only if image is selected
                    if($image_name!="")
                    {

                    
                        //auto rename image
                        //get extension of image
                        $ext=end(explode('.',$image_name));
                        //rename image
                        $image_name="Scheme_Category".rand(000,999).'.'.$ext;
                        

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check if uploaded
                        //if not uploaded then stop and redirect with error message
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload the image</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/add-category.php');
                            //stop the process
                            die();

                        }
                }


                }
                else
                {
                    //dont upload and set $image as blank
                    $image_name="";
                }

                //Create sql query to inser category to database
                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";
                $res=mysqli_query($conn,$sql);
                //check if data added
                if($res==true)
                {
                    //yes
                    $_SESSION['add']="<div class='success'>Category Added Successfully</div>" ;
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');

                }
                else
                {
                    //no
                    $_SESSION['add']="<div class='error'>Failed to Add Category</div>";
                    header('location:'.SITEURL.'admin/add-category.php');

                }
            
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>

