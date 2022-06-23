<?php
    include('partials/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Scheme</h1>
        <br><br>
        
        <?php
            //get id of selected category
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                // create sql query ot get details
                $sql2= "SELECT * FROM tbl_schemes WHERE id=$id";
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
                    $title =$row['title'];
                    $current_category=['category_id'];
                    
                    $current_image=$row['image_name'];
                    $effective_date=$row['effective_date'];
                    $government_department=$row['government_department'];
                    $applicable_for = $row['applicable_for'];
                    $for_what = $row['for_what'];
                    $satisfying_condition= $row['satisfying_condition'];
                    $relief_type = $row['relief_type'];
                    $how_to = $row['how_to'];
                    $documents_required=$row['documents_required'];
                    $documents=$row['documents'];
                    $website = $row['website'];
                    $featured=$row['featured'];
                    $active=$row['active'];
                

                }
                else
                {
                    $_SESSION['no-category-found']="<div class='error'>Scheme Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-schemes.php');
                }
            }
            }

            else
            {
                    //redirect to manage scheme page
                    header('location:'.SITEURL.'admin/manage-schemes.php');
            }
            
            
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" value="<?php echo $title;?>" ></td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                               //create PHP code to display categories from database
                               //1. get all active categories
                               $sql="SELECT * FROM tbl_category WHERE active='Yes' ";
                               $res=mysqli_query($conn,$sql);
                               
                               $count=mysqli_num_rows($res);
                               if($count>0)
                               {
                                   //we have categories
                                   while($row2=mysqli_fetch_assoc($res))
                                   {
                                       $category_id=$row2['id'];
                                       $category_title=$row2['title'];
                                       ?>
                                       <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                       <?php
                                   }
                               }
                               else
                               {
                                    ?>
                                   <option value="0">No Category found</option>
                                   <?php
                               }
                            ?>

                               
                            
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                    <?php
                        if($current_image != "")
                        {
                            ?>
                            <img src="<?php echo SITEURL;?>images/scheme/<?php echo $current_image;?>" width="150px">
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
                    <td>New Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Effective Date</td>
                    <td><input type="date" name="effective_date" value="<?php echo $effective_date;?>" ></td>
                </tr>
                <tr>
                    <td>Government Department:</td>
                    <td><input type="text" name="government_department" value="<?php echo $government_department;?>"  ></td>
                </tr>
                <tr>
                    <td>Applicable for:</td>
                    <td><input type="text" name="applicable_for" value="<?php echo $applicable_for;?>"  ></td>
                </tr>
                <tr>
                    <td>for what specifically:</td>
                    <td><input type="text" name="for_what" value="<?php echo $for_what;?>"  ></td>
                </tr>
                <tr>
                    <td>Satisfying Condition:</td>
                    <td><textarea name="satisfying_condition"  cols="30" rows="5"><?php echo $satisfying_condition;?></textarea></td>
                </tr>

                <tr>
                    <td>Relief Type</td>
                    <td><input type="text" name="relief_type" value="<?php echo $relief_type;?>" ></td>
                </tr>
                <tr>
                    <td>Steps to apply:</td>
                    <td><textarea name="how_to"  cols="30" rows="5"><?php echo $how_to;?></textarea></td>
                </tr>

                <tr>
                    <td>Documents Required:</td>
                    <td><textarea name="documents_required"  cols="30" rows="5"><?php echo $documents_required;?></textarea></td>
                </tr>
                <tr>
                    <td>Current Document</td>
                    <td>
                    <?php
                        if($documents!= "")
                        {
                            
                            echo $documents;
                            

                        }
                        else{
                            //display error message
                            echo "<div class='error'> Document Not Added </div>";
                        }
                        
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Add New Document</td>
                    <td>
                        <input type="file" name="pdf">
                    </td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website" value="<?php echo $website;?>" ></td>
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
                    <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Add Scheme" class="btn-secondary">
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
        $title =$_POST['title'];
        $category= $_POST['category'];
        $effective_date=$_POST['effective_date'];
        $government_department=$_POST['government_department'];
        $applicable_for = $_POST['applicable_for'];
        $for_what = $_POST['for_what'];
        $satisfying_condition= $_POST['satisfying_condition'];
        $relief_type = $_POST['relief_type'];
        $how_to = $_POST['how_to'];
        $documents_required=$_POST['documents_required'];
        $website = $_POST['website'];
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
                        $image_name="Scheme-name".rand(000,999).'.'.$ext;
                        

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/scheme/".$image_name;
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check if uploaded
                        //if not uploaded then stop and redirect with error message
                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload the image</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-schemes.php');
                            //stop the process
                            

                        }
                 //remove current image if available
                 if($current_image!="")
                 {
                    $remove_path="../images/scheme/.$current_image";
                    $remove =unlink($remove_path);
                    //cheeck if image reomoved or not
                    // if failed to remove then display message and stop the process
                    if($remove==false)
                    {
                       $_SESSION['failed-remove']="<div class='error'>Falied to remove the current image</div>";
                       header('location:'.SITEURL.'admin/manage-scheme.php');
                       
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

         if(isset($_FILES['pdf']['name']))
         {
             //get image detatils
             $document=$_FILES['pdf']['name'];
             if($document!="")
             {
                 //image available
                 //upload new image
                         //auto rename image
                        //get extension of image
                        $ext=end(explode('.',$document));
                        //rename image
                        $document="Scheme-name".rand(000,999).'.'.$ext;
                        

                        $source_path=$_FILES['pdf']['tmp_name'];
                        $destination_path="docs/".$document;
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check if uploaded
                        //if not uploaded then stop and redirect with error message
                        if($upload==false)
                        {
                            $_SESSION['upload2']="<div class='error'>Failed to upload the pdf</div>";
                            //redirect
                            header('location:'.SITEURL.'admin/manage-schemes.php');
                            //stop the process
                            

                        }
                 //remove current image if available
            }
            else
            {
               $docuemnt=$documents;
            }
         }
        else{
            $document=$documents;
        }
         //create sql qurey to update admin
         $sql3="UPDATE tbl_schemes SET
            title='$title',
            category='$category',
            effective_date='$effective_date',
            government_department='$government_department',
            applicable_for='$applicable_for',
            for_what='$for_what',
            satisfying_condition='$satisfying_condition',
            relief_type='$relief_type',
            how_to='$how_to',
            documents_required='$documents_required',
            documents='$document',
            website='$website',
            image_name='$image_name',
            category_id =$category,
            featured='$featured',
            active ='$active'
         WHERE id= '$id'
         ";

         //Execute query
         $res3=mysqli_query($conn, $sql3);

         //check whether the query executed successfully or not
         if($res3==true)
         {
             //Query Executed and Admin updated
             $_SESSION['update']="<div class='success'>Scheme Updated Successfully.</div>";
             //Redirect to Manage Admin Page
             header('location:'.SITEURL.'admin/manage-schemes.php');
         }
         else{
             $_SESSION['update']="<div class='error'> Failed to Update</div>";
              header('location:'.SITEURL.'admin/manage-schemes.php');
         }
    }
?>

<?php
    include('partials/footer.php');
?>