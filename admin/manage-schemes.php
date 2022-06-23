<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Schemes</h1>

        <br/><br/>

        <?php 
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['upload2']))
            {
                echo $_SESSION['upload2'];
                unset($_SESSION['upload2']);
            }
            if(isset($_SESSION['unauthorize']))
            {
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }


            
            
        ?>
        <br>
                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL;?>admin/add-schemes.php" class="btn-primary">Add Schemes</a>
                <br/><br/><br/>
                <table class="tbl-scheme">


                

                    <tr>
                        <th>S.N</th>  
                        <th>Title</th>
                        <th>Category Id</th>
                        <th>Image</th>
                        
                        <th>Effective Date</th>
                        <th>Government Department</th>
                        <th>Applicable for</th>
                        <th>For what specifically</th>
                        <th>Relief Type</th>
                        <th>Actions</th>  
                        
                    </tr>

                    <?php
                        $sql="SELECT * FROM tbl_schemes";
                        //execute query
                        $res=mysqli_query($conn,$sql);

                        //count rows
                        $count=mysqli_num_rows($res);

                        $sn=1;

                        //check if data in data base
                        if($count>0)
                        {
                            //we have data
                            //get data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $title =$row['title'];
                                $category= $row['category'];
                                $image_name=$row['image_name'];
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
                               
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td><?php echo $category;?></td>
                                        <td>
                                            <?php
                                                //check whether image name avialable or not
                                                if($image_name!="")
                                                {
                                                    //display image
                                                    ?>
                                                    <img src="<?php echo SITEURL?>images/scheme/<?php echo $image_name;?>" width="100px">
                                                    <?php
                                                }
                                                else
                                                {
                                                    //display the message
                                                    echo "<div class='error'>Image not added</div>";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $effective_date;?></td>
                                        <td><?php echo $government_department;?></td>
                                        <td><?php echo $applicable_for;?></td>
                                        <td><?php echo $for_what;?></td>
                                        
                                        <td><?php echo $relief_type;?></td>

                                        
                                       
                                        
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-schemes.php?id=<?php echo $id;?>" class="btn-secondary">Update Scheme</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-schemes.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>&pdf_name=<?php echo $documents;?>" class="btn-danger">Delete Scheme</a>
                                            
                                        </td>

                                    </tr>
                                <?php
                                
                            }
                        }
                        else
                        {
                            //dont have data
                            //We'll display the message inside table
                            ?>
                            <tr>
                                <td colspan="18"><div class="error">No Scheme Added</div></td>
                            </tr>
                            <?php
                        }
                    ?>



                  
                </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>