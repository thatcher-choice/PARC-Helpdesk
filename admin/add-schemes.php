<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Scheme</h1>
        <br/><br/>
        <?php
            if(isset($_SESSION['upload'])) //if session is assigned upload
                {
                    echo($_SESSION['upload']); // printing session message
                    unset($_SESSION['upload']); //removing session message
                }
            if(isset($_SESSION['upload_pdf'])) //if session is assigned upload_pdf
                {
                    echo($_SESSION['upload_pdf']); // printing session message
                    unset($_SESSION['upload_pdf']); //removing session message
                }
            if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title" placeholder="Title of your Scheme" ></td>
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
                                   while($row=mysqli_fetch_assoc($res))
                                   {
                                       $id=$row['id'];
                                       $title=$row['title'];
                                       
                                       echo "<option value='$id'>$title</option>";
                                       
                                   }
                               }
                               else
                               {
                                    
                                   echo "<option value='0'>No Category found</option>";
                                   
                               }
                            ?>

                               
                            
                        </select>
                    </td>
                    
                </tr>
                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Effective Date</td>
                    <td><input type="date" name="effective_date" placeholder="Enter the date from when the scheme is effective"></td>
                </tr>
                <tr>
                    <td>Government Department:</td>
                    <td><input type="text" name="government_department" placeholder="Government Department" ></td>
                </tr>
                <tr>
                    <td>Applicable for:</td>
                    <td><input type="text" name="applicable_for" placeholder="Scheme applicable for" ></td>
                </tr>
                <tr>
                    <td>for what specifically:</td>
                    <td><input type="text" name="for_what" placeholder="What is scheme for specifically" ></td>
                </tr>
                <tr>
                    <td>Satisfying Condition:</td>
                    <td><textarea name="satisfying_condition"  cols="30" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td>Relief Type</td>
                    <td><input type="text" name="relief_type" placeholder="Relief type" ></td>
                </tr>
                <tr>
                    <td>Steps to apply:</td>
                    <td><textarea name="how_to"  cols="30" rows="5"></textarea></td>
                </tr>

                <tr>
                    <td>Documents Required:</td>
                    <td><textarea name="documents_required"  cols="30" rows="5"></textarea></td>
                </tr>


                <tr>
                    <td>Add Documents</td>
                    <td>
                        <input type="file" name="pdf">
                    </td>
                </tr>
                <tr>
                    <td>Website:</td>
                    <td><input type="text" name="website" placeholder="Website" ></td>
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>                </tr>
                <tr>
                    <td>active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>           
                </tr>




                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Scheme" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
    //process the value from form and save it in database 
    // check whether the submit button is clicked or not

            if(isset($_POST['submit']))
            {
                // Button Clicked
                //echo "Button Clicked";

                //1.get data from form
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
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured="No";
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active="No";
                }
                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];
                    if($image_name!="")
                    {
                        $ext=end(explode('.',$image_name));
                        $image_name="Scheme-Name".rand(000,999).'.'.$ext;
        
                        $src=$_FILES['image']['tmp_name'];
                        $dst="../images/scheme/".$image_name;
                        $upload=move_uploaded_file($src,$dst );

                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            header("location:".SITEURL.'admin/add-schemes.php');
                            die();
                        }
                    
                    }
                }
                else
                {
                    $image_name = "";
                }

                if(isset($_FILES['pdf']['name']))
                {
                    $documents=$_FILES['pdf']['name'];
                    if($documents!="")
                    {
                        $ext2=explode('.',$documents);
        
                        $src2=$_FILES['pdf']['tmp_name'];
                            
                        $upload_pdf=move_uploaded_file($src2,"docs/".$documents );
                            
                            if($upload_pdf==false)
                            {
                                $_SESSION['upload_pdf']="<div class='error'>Failed to upload pdf</div>";
                                header("location:".SITEURL.'admin/add-schemes.php');
                                die();
                            }
                        }

                    }
                
                else 
                {
                    $documents="";
                }
        

                $sql2="INSERT INTO tbl_schemes SET 
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
                    documents='$documents',
                    website='$website',
                    image_name='$image_name',
                    category_id =$category,
                    featured='$featured',
                    active ='$active'
                ";
                


                //echo $sql;

                //3. Execute Query and save data in database
                $res2=mysqli_query($conn,$sql2);

                //4.Check wether the(Query is Executed) data is inserted or not and diplay appropriate message
                if($res2==true)
                {
                    // Data Inserted
                    //echo "Data inserted";
                    //create a session variable to display message
                    $_SESSION['add']="<div class='success'>Scheme Added Successfully</div>";
                    //Redirect page manage admin
                    header("location:".SITEURL.'admin/manage-schemes.php');
                }
                else{
                    //echo "Failed to insert the data";
                    //create a session variable to display message
                    $_SESSION['add']="<div class='error'>Failed to Add Scheme</div>";
                    //Redirect page Add admin
                    header("location:".SITEURL.'admin/manage-schemes.php');
                }
                
            }
?>

                
    </div>
</div>

<?php include('partials/footer.php'); ?>

