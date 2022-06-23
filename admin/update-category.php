<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            //get id of selected category
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                // create sql query ot get details
                $sql= "SELECT * FROM tbl_category WHERE id=$id";
                //Execute the query
                $res=mysqli_query($conn,$sql);
                //check if query executed                   
                //check if data available
                if($res==true)
                {
                $count=mysqli_num_rows($res);
                //check if we have admin data or not
                if($count==1)
                {
                    //get details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    $title=$row['title'];
                    $current_image=$row['image_name'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                

                }
                else
                {
                    $_SESSION['no-category-found']="<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
            }

            else
            {
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-category.php');
            }
            
            
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>

                        <?php
                        if($current_image != "")
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                            <?php

                        }
                        else{
                            //display error message
                            echo "<div class='error'> Image Not Added </div>";
                        }
                        
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td> Featured: </td>

                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hiddem" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">

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
         $id=$_POST['id'];
         $title=$_POST['title'];
         
         $featured=$_POST['featured'];
         $active=$_POST['active'];
         
         //update database if selected
         if(isset($_FILES['image']['name']))
         {
             //get image detatils
             $image_name=$_FILES['image']['name'];
             if($image_name!="")
             {
                 //image available
                 //upload new image
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
                            $_SESSION['upload']="<div class='error'>Faled to upload the image</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //stop the process
                            die();

                        }
                 //remove current image if available
                 if($current_image!="")
                 {
                    $remove_path="../images/category/.$current_image";
                    $remove =unlink($remove_path);
                    //cheeck if image reomoved or not
                    // if failed to remove then display message and stop the process
                    if($remove==false)
                    {
                       $_SESSION['failed-remove']="<div class='error'>Falied to remove the current image</div>";
                       header('location:'.SITEURL.'admin/manage-category.php');
                       die();
                    }

                 }




             }
             else
             {
                $image_name=$current_image;
             }
         }
         else{
             $image_name=$current_image;
         }
         //create sql qurey to update admin
         $sql2="UPDATE tbl_category SET
         title='$title',
         image_name='$image_name',
         featured='$featured',
         active='$active'
         WHERE id= '$id'
         ";

         //Execute query
         $res2=mysqli_query($conn, $sql2);

         //check whether the query executed successfully or not
         if($res2==true)
         {
             //Query Executed and Admin updated
             $_SESSION['update']="<div class='success'>Category Updated Successfully.</div>";
             //Redirect to Manage Admin Page
             header('location:'.SITEURL.'admin/manage-category.php');
         }
         else{
             $_SESSION['update']="<div class='error'> Faield to Update</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
         }
    }
?>

<?php
    include('partials/footer.php');
?>