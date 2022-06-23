<?php include('../config/constants.php')?>
<?php
    //echo "Delete Page";
    //Check if image_name and id set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']) AND isset($_GET['pdf_name']))
    {
        //get the value and delete
        echo "Get value and delete";
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];
        $documents=$_GET['pdf_name'];
        //Remove the physical image file
        if($image_name!= "")
        {
            $path="../images/scheme/".$image_name;
            $remove=unlink($path);
            //if failed to remove them add error message
            if($remove==false)
            {
                //set the session message 
                $_SESSION['upload']="<div class='error'> Failed to Remove Scheme Image</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-schemes.php');

                //stop
                
            }
        }
        if($documents!= "")
        {
            $path2="docs/".$documents;
            $remove2=unlink($path2);
            //if failed to remove them add error message
            if($remove2==false)
            {
                //set the session message 
                $_SESSION['upload2']="<div class='error'> Failed to Remove Scheme Document</div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-schemes.php');

                //stop
                
            }
        }
        //delete the data from database
        $sql="DELETE FROM tbl_schemes WHERE id='$id'";

        $res=mysqli_query($conn,$sql);

        if($res==true)
        {
            $_SESSION['delete']="<div class='success'>Scheme deleted successfully.</div>";
            header('location:'.SITEURL.'admin/manage-schemes.php');
        }
        //rdirect to manage category page with message
        else
        {
            $_SESSION['delete']="<div class='success'>Failed to delete the scheme.</div>";
            header('location:'.SITEURL.'admin/manage-schemes.php');
        }
    }
    else{

        $_SESSION['unauthorize']="<div class='error'>Failed to delete scheme.</div>";

        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-schemes.php');
    }
?>