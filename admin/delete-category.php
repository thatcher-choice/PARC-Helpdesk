<?php include('../config/constants.php')?>
<?php
    //echo "Delete Page";
    //Check if image_name and id set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //get the value and delete
        echo "Get value and delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        //Remove the physical image file
        if($image_name!= "")
        {
            $path="../images/category/".$image_name;
            $remove=unlink($path);
            //if failed to remove them add error message
            if($remove==false)
            {
                //set the session message 
                $_SESSION['remove']="<div class='error'> Failed to Remove Category Image</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-category.php');

                //stop
                die();
            }
        }
        //delete the data from database
        $sql="DELETE FROM tbl_category WHERE id='$id'";

        $res=mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Category deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        //rdirect to manage category page with message
    }
    else{

        $_SESSION['delete']="<div class='error'>Failed to delete category.</div>";

        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>