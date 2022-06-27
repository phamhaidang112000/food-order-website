<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1> <br><br>
        <?php 
            
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // remove session variable
            }
        ?>

        <?php 
            if(isset($_GET["id"])){
                $id = $_GET["id"];

                $sql = "SELECT * FROM tbl_food WHERE id = $id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){

                    $row = mysqli_fetch_assoc($res);

                    $title = $row["title"];
                    $description = $row["description"];
                    $price = $row["price"];
                    $current_image = $row["image_name"];
                    $food_category_id = $row["category_id"];
                    $featured = $row["featured"];
                    $active = $row["active"];

                }else{

                    $_SESSION["no-food-found"] = "<div class='error'>Can not found Food</div>";

                    header("location:".SITEURL."admin/update-food.php");

                }

            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">

            <table class="tbl-full">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5" ><?php echo $description ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>
    
                    <tr>
                        <td>Current Image: </td>
                        <td>
                            <?php 
                                if($current_image != ''){

                                    ?>

                                    <img src="<?php echo SITEURL."images/food/".$current_image ?>" alt="Can't load image" width="60px">

                                    <?php

                                }else{
                                    echo "<div class='error>Image not found</div>";
                                }
                            
                            ?>
                        </td>
                    </tr>
    
                    <tr>
                        <td>New Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category: </td>
                    <td>
                        <select name="category" >
    
                            <?php 
                                // Display category from database
                                $sql2 = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                                $res2 = mysqli_query($conn , $sql2);

                                $count2  = mysqli_num_rows($res2);

                                if($count2 > 0){
                                    while($row2 = mysqli_fetch_assoc($res2)){
                                        $category_id = $row2['id'];
                                        $category_title = $row2["title"];
                                        
                                        ?>
                                        <option <?php if($category_id == $food_category_id) echo "selected"; ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option>
                                        <?php
                                    }


                                }else{
                                    ?>
                                    <option value="0">No category founded</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                    </tr>

                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" <?php if($featured == "Yes") echo "checked"?> name="featured" value="Yes"> Yes
                            <input type="radio" <?php if($featured == "No") echo "checked"?> name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" <?php if($active == "Yes") echo "checked"?> name="active" value="Yes"> Yes
                            <input type="radio" <?php if($active == "No") echo "checked"?> name="active" value="No"> No
                        </td>
                    </tr>
    
    
                    <tr>
                        <td colspan="2">

                            <input type="submit" name="submit" value="Update Food" class="btn-secondary" style="cursor:pointer;">
                        </td>
                    </tr>
    
                </table>
        </form>

        <?php 
            if(isset($_POST["submit"])){

                
                $title = $_POST["title"];
                $description = $_POST["description"];
                $price = $_POST["price"];
                
                $category = $_POST["category"];
                $featured = $_POST["featured"];
                $active = $_POST["active"];

                // Update new image if selected
                if(isset($_FILES["image"]["name"])){

                    $image_name = $_FILES["image"]["name"];
                    
                    if($image_name != ""){

                        $arr_var = explode('.',$image_name);
                        
                        $ext = end($arr_var);

                        $image_name = "Food-Name-".rand(0000,9999).".".$ext;

                        $src_path = $_FILES["image"]["tmp_name"];

                        $dest_path = "../images/food/".$image_name; 

                        $upload = move_uploaded_file($src_path , $dest_path); //Hàm move_uploaded_file() dùng để di chuyển tập tin được tải lên vào một nơi được chỉ định.

                        if($upload == FALSE){

                            $_SESSION["upload"] = "<div class = 'error'>Failed to upload file</div>";

                            header("location:".SITEURL."admin/update-food.php");

                            die();
                        }

                        if($current_image != ""){

                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove == FALSE){

                                $_SESSION["remove-failed"] = "<div class = 'error'>Failed to remove current image</div>";

                                header("location:".SITEURL."admin/manage-food.php");

                                die();
                            }

                        }
    
                        
    
                    }else{
                        $image_name = $current_image;
                    }

                }else{
                    $image_name = $current_image;
                }
                

                $sql3 = "UPDATE tbl_food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id";
                
                $res3 = mysqli_query($conn , $sql3);

                if($res3 == TRUE){

                    $_SESSION["update"] = "<div class = 'success'>Food Update Successfully</div>";

                }else{

                    $_SESSION["update"] = "<div class = 'error'>Food Update Unsuccessfully</div>";

                }

                header("location:".SITEURL."admin/manage-food.php");

            }
        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>