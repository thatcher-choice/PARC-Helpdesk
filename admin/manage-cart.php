<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Queries</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Scheme</th>
                        <th>Gender</th>
                        
                        <th>Age</th>
                        <th>Query Date</th>
                        <th>Employment Status</th>
                        <th>Query Status</th>
                        
                        
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_cart ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
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
                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $ctzn_name; ?></td>
                                        <td><?php echo $contact_no; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $ctzn_address; ?></td>
                                        <td><?php echo $scheme;?></td>
                                        
                                        <td><?php echo $ctzn_gender; ?></td>
                                        <td><?php echo $ctzn_age; ?></td>
                                        <td><?php echo $query_date; ?></td>
                                        <td><?php echo $employment_status; ?></td>

                                        <td>
                                            <?php 
                                                // 

                                                if($query_status=="Asked")
                                                {
                                                    echo "<label>$query_status</label>";
                                                }
                                                elseif($query_status=="In Progress")
                                                {
                                                    echo "<label style='color: orange;'>$query_status</label>";
                                                }
                                                elseif($query_status=="Answered")
                                                {
                                                    echo "<label style='color: green;'>$query_status</label>";
                                                }
                                                elseif($query_status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$query_status</label>";
                                                }
                                            ?>
                                        </td>
                                        
                                        
                                        
                                        

                                        
                                        
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-cart.php?id=<?php echo $id; ?>" class="btn-secondary">Update Query</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Query not Available
                            echo "<tr><td colspan='12' class='error'>Query not Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>