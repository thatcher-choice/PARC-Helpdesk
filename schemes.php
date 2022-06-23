<?php include('partials-front/menu.php'); ?>


    <!-- Scheme sEARCH Section Starts Here -->
    <section class="scheme-search text-center">
        <div class="container">
            
            <form action="<?php SITEURL;?>scheme-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Scheme.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Scheme sEARCH Section Ends Here -->



    <!-- Scheme MEnu Section Starts Here -->
    <section class="scheme-menu">
        <div class="container">
            <h2 class="text-center">Scheme Menu</h2>
            <?php
                $sql="SELECT * FROM tbl_schemes WHERE active='Yes'";
                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        $government_department=$row['government_department'];
                        $for_what=$row['for_what'];
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
                            
                            <a href="<?php echo SITEURL;?>order.php?scheme_id=<?php echo $id;?>" class="btn btn-primary">Ask Query</a>
                        </div>
                    </div>
                    <?php
                    }
                }
                    else
                    {
                        echo "<div class='error'>Scheme not found</div>";

                    }
                
            ?>




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Scheme Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
