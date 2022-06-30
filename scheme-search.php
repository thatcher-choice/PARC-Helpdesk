<?php include('partials-front/menu.php'); ?>


    <!-- scheme sEARCH Section Starts Here -->
    <section class="scheme-search text-center">
        <div class="container">
            <?php
                $search= mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            
            <h2 class="text-white">Schemes on Your Search <a href="#" class="text-white">"<?php echo $search;?>"</a></h2>

        </div>
    </section>
    <!-- scheme sEARCH Section Ends Here -->



    <!-- scheme MEnu Section Starts Here -->
    <section class="scheme-menu">
        <div class="container">
            <h2 class="text-center">Scheme Menu</h2>

            <?php
                
                
                $sql="SELECT * FROM tbl_schemes WHERE title LIKE '%$search%' OR for_what LIKE '%$search%'";

                $res=mysqli_query($conn,$sql);
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['title'];
                        $government_department=$row['government_department'];
                        $for_what= $row['for_what'];
                        $image_name=$row['image_name'];
                        ?>

                        <div class="scheme-menu-box">
                            <div class="scheme-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        echo "<div class='error'>Image not available</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL;?>images/scheme/<?php echo $image_name;?>" alt="Scheme$" class="img-responsive img-curve">
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

                                <a href="#" class="btn btn-primary">Ask Query</a>
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
    <!-- scheme Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
