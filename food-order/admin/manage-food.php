<html>
    <head>
        <title>Food Order Website - Admin Page</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>

       
        <?php include("partials/menu.php"); ?>

        <!-- Main content section start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE FOOD</h1><br><br>

                 <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); // remove session variable
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']); // remove session variable
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); // remove session variable
                    }

                    if(isset($_SESSION['no-food-found'])){
                        echo $_SESSION['no-food-found'];
                        unset($_SESSION['no-food-found']); // remove session variable
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']); // remove session variable
                    }

                    if(isset($_SESSION['remove-failed'])){
                        echo $_SESSION['remove-failed'];
                        unset($_SESSION['remove-failed']); // remove session variable
                    }


                ?>

                <br><br>


                <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add food</a>
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <!-- <th>Category</th> -->
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $stt = 1;

                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn , $sql);

                        $count = mysqli_num_rows($res);

                        if($count > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row["id"];
                                $title = $row['title'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>
                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $title ?></td>
                                    <td><?php echo $description ?></td>
                                    <td><?php echo $price.' $' ?></td>
                                    <td>
                                        <?php 
                                            if($image_name != ''){
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="Can't load image" width="60px">
                                                <?php
                                            }else{
                                                echo "<div class='error'>Image is not added</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ?>admin/update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update Food</a>
                                        <a href="<?php echo SITEURL ?>admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Food</a>
                                    </td>
                                </tr>

                                <?php
                            }


                        }else{

                            echo "<tr><td colspan='7' class='error'>No food found</td></tr>";

                        }
                    ?>
                </table>
            </div>
        </div>
        <!-- Main content section end -->


        <?php include("partials/footer.php") ?>

    </body>
</html>