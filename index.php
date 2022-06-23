    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="scheme-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>scheme-search.php" method="POST">
                <input class="btn" type="search" name="search" placeholder="Search for scheme.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- scheme sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore schemes</h2>
            
            <?php
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured ='Yes' LIMIT 3";
                $res= mysqli_query($conn, $sql);

                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL;?>category-schemes.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                
                                else{
                                    ?>
                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Cat" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-teal"><?php echo $title;?></h3>
                            </div>
                        </a>

                        <?php
                    }


                }
                else
                {
                    echo "<div class='error'> Category not added</div>";

                }
            ?>




            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- scheme MEnu Section Starts Here -->
    <section class="scheme-menu">
        <div class="container">
            <h2 class="text-center">Scheme Menu</h2>
            <?php
                $sql2 = "SELECT * FROM tbl_schemes WHERE active='Yes' AND featured='Yes' LIMIT 6 ";
                $res2=mysqli_query($conn,$sql2);
                $count2= mysqli_num_rows($res2);
                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['title'];
                        $government_department=$row2['government_department'];
                        $image_name=$row2['image_name'];
                        $for_what=$row2['for_what'];
                        ?>

                        <div class="scheme-menu-box">
                            <div class="scheme-menu-img">

                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'> Image not available</div>";
                                    }
                                    else
                                    {  
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/scheme/<?php echo $image_name;?>" alt="Sch" class="img-responsive img-curve">
                                        <?php
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

                                 <a href="<?php echo SITEURL;?>order.php?scheme_id=<?php echo $id;?>" class="btn btn-primary">Ask Query</a>
                            </div>
                        </div>
                        
                        <?php
                }
                    
            }
                else{
                        echo "<div class='error'> Scheme not available</div>";
                }
            
            ?>

            

            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All schemes</a>
        </p>
    </section>
    <!-- scheme Menu Section Ends Here -->

<?php include('partials-front/footer.php');?>