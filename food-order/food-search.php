<?php include("./partials-front/menu.php") ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 
                $search = mysqli_real_escape_string($conn , $_POST['search']);
            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white"><?php echo $search ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%'";

                $res = mysqli_query($conn , $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){

                    while($row = mysqli_fetch_assoc($res)){
                        
                        $food_id = $row['id'];
                        $food_title = $row['title'];
                        $food_description = $row['description'];
                        $food_price = $row['price'];
                        $food_img_name = $row['image_name'];
                        $food_category_id = $row['category_id'];
                        $food_featured = $row['featured'];
                        $food_active = $row['active'];

                        ?>

                         <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php 
                                        if($food_img_name == ""){

                                            echo "<div class='error'>Image not Available</div>";

                                        }else{
                                            ?>
                                            
                                                <img src="<?php echo SITEURL."images/food/".$food_img_name ?>" alt="Not load" class="img-responsive img-curve">

                                            <?php

                                        }
                                ?>
                            </div>

                            <div class="food-menu-desc">
                                <h4><?php echo $food_title ?></h4>
                                <p class="food-price"><?php echo $food_price ?></p>
                                <p class="food-detail">
                                    <?php echo $food_description ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }

                }else{
                    echo "<div class='error'>No Food Found . Try again.</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include("./partials-front/footer.php") ?>