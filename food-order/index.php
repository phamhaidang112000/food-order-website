<?php include("./partials-front/menu.php") ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <br><br>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
           if(isset($_SESSION['order'])){
                echo $_SESSION['order'];
                unset($_SESSION['order']); // remove session variable
            }
    
    ?>
     <br><br>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes' AND featured = 'Yes' LIMIT 3";

                $res = mysqli_query($conn , $sql);

                $count = mysqli_num_rows($res);

                if($count > 0){
                    while($row = mysqli_fetch_assoc($res)){
                        $category_id = $row['id'];
                        $category_title = $row["title"];
                        $category_img_name = $row["image_name"];

                        ?>

                        <a href="<?php echo SITEURL."category-foods.php?category_id=".$category_id."&category_name=".$category_title ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($category_img_name == ""){

                                        echo "<div class='error'>Image not Available</div>";

                                    }else{
                                        ?>
                                        
                                        <img src="<?php echo SITEURL."images/category/".$category_img_name ?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php

                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $category_title ?></h3>
                            </div>
                        </a>
                        <?php
                    }

                }else{
                    echo "<div class='error'>Category not found</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                $sql2 = "SELECT * FROM tbl_food WHERE active = 'Yes' AND featured = 'Yes' LIMIT 6";

                $res2 = mysqli_query($conn , $sql2);
                
                $count2 = mysqli_num_rows($res2);

                if($count2 > 0){

                    while($row2 = mysqli_fetch_assoc($res2)){

                        $food_id = $row2['id'];
                        $food_title = $row2['title'];
                        $food_description = $row2['description'];
                        $food_price = $row2['price'];
                        $food_img_name = $row2['image_name'];
                        $food_category_id = $row2['category_id'];
                        $food_featured = $row2['featured'];
                        $food_active = $row2['active'];

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

                                <a href="<?php echo SITEURL."order.php?food_id=".$food_id ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php

                    }

                }else{
                     echo "<div class='error'>Foods not found</div>";
                }
            
            ?>

            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="<?php echo SITEURL."foods.php" ?>">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->



<?php include("./partials-front/footer.php") ?>