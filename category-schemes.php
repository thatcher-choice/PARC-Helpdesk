<?php include('partials-front/menu.php'); ?>
    
    <?php
        if(isset($_GET['category_id']))
        {
            //category id is set and get the id
            $category_id= $_GET['category_id'];
            $sql="SELECT title FROM tbl_category WHERE id=$category_id";
            $res=mysqli_query($conn, $sql);
            $row= mysqli_fetch_assoc($res);
            $category_title= $row['title'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    ?>

    <!-- scheme sEARCH Section Starts Here -->
    <section class="scheme-search text-center">
        <div class="container">
            
            <h2 class="text-white">Schemes on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

        </div>
    </section>
    <!-- scheme sEARCH Section Ends Here -->



    <!-- scheme MEnu Section Starts Here -->
    <section class="scheme-menu">
        <div class="container">
            <h2 class="text-center">Scheme Menu</h2>
            <?php
                $sql2="SELECT * FROM tbl_schemes WHERE category_id=$category_id";
                $res2=mysqli_query($conn,$sql2);
                $count2=mysqli_num_rows($res2);
                if($count2>0)
                {
                   
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $image_name=$row2['image_name'];
                        $government_department=$row2['government_department'];
                        $for_what=$row2['for_what'];
                        ?>
                        <div class="scheme-menu-box">
                            <div class="scheme-menu-img">
                            <?php
                            if($image_name!="")
                            {
                                ?>
                                <img src="<?php echo SITEURL;?>images/scheme/<?php echo $image_name;?>" alt="Scheme#" class="img-responsive img-curve">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Scheme image not found</div>";

                            }
                                ?>
                            </div>

                            <div class="scheme-menu-desc">
                                <h4><?php echo $title;?></h4>
                                <p class="scheme-department"><?php echo $government_department;?></p>
                                <p class="scheme-detail">
                                    <?php echo $for_what;?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL;?>order.php?scheme_id=<?php echo $id;?>" class="btn btn-primary">Add to Cart</a>
                            </div>
                        </div>
                        <?php
                    }
                }

                else
                {
                    echo "<div class ='error'>Scheme not available</div>";
                }
            ?>

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- scheme Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
