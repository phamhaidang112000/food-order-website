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
                <h1>MANAGE CATEGORY</h1>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); // remove session variable
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); // remove session variable
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']); // remove session variable
                    }

                    if(isset($_SESSION['no-category-found'])){
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']); // remove session variable
                    }
                    
                     if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']); // remove session variable
                    }

                ?>


                <a href="add-category.php" class="btn-primary">Add category</a>
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $sql = "SELECT * FROM tbl_category";

                        $res = mysqli_query($conn , $sql);

                        $count = mysqli_num_rows($res);

                        $stt = 1;

                        if($count > 0){
                            while($row = mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                <tr>
                                    <td><?php echo $stt++ ?></td>
                                    <td><?php echo $title ?></td>
                                    <td>
                                        <?php 
                                            if($image_name != ''){
                                                ?>
                                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="Can't load image" width="60px">
                                                <?php
                                            }else{
                                                echo "<div class='error'>Image is not added</div>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured ?></td>
                                    <td><?php echo $active ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                                        <a href="<?php echo SITEURL ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Category</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }else{
                            ?>
                                <tr>
                                    <td colspan="6"><div class="error">No category added</div></td>
                                </tr>
                            <?php

                        }
                    ?>
                   
                   
                </table>

            </div>
        </div>
        <!-- Main content section end -->


        <?php include("partials/footer.php") ?>

    </body>
</html>