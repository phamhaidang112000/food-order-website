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

                $sql = "SELECT * FROM tbl_category WHERE id = $id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){

                    $row = mysqli_fetch_assoc($res);
                    $title = $row["title"];
                    $current_image = $row["image_name"];
                    $featured = $row["featured"];
                    $active = $row["active"];

                }else{

                    $_SESSION["no-category-found"] = "<div class='error'>Can not found category</div>";
                    header("location:".SITEURL."admin/manage-category.php");

                }

            }else{
                header("location:".SITEURL."admin/manage-category.php");
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
                        <td>Current Image: </td>
                        <td>
                            <?php 
                                if($current_image != ''){

                                    ?>

                                    <img src="<?php echo SITEURL."images/category/".$current_image ?>" alt="Can't load image" width="60px">

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
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">

                            <input type="submit" name="submit" value="Update Category" class="btn-secondary" style="cursor:pointer;">
                        </td>
                    </tr>
    
                </table>
        </form>

        <?php 
            if(isset($_POST["submit"])){
                $id = $_POST["id"];
                $title = $_POST["title"];
                $current_image = $_POST["current_image"];
                $featured = $_POST["featured"];
                $active = $_POST["active"];

                // Update new image if selected
                if(isset($_FILES["image"]["name"])){

                    $image_name = $_FILES["image"]["name"];

                    if($image_name != ''){

                        $ext = end(explode('.',$image_name)); //hàm end đưa con trỏ về vị trí cuối mảng , hàm explode trả về mảng các từ tách theo ký tự quy định
    
                        $image_name = "Food_Category_".rand(000,999).".".$ext;
    
                        
    
                        $source_path = $_FILES["image"]["tmp_name"];
                        $destination_path = "../images/category/".$image_name;
    
                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
    
                        // Check whether image is uploaded or not
                        if($upload == false){
                            $_SESSION["upload"] = "<div class='error'> Failed to upload the image </div>";
    
                            header("location:".SITEURL."admin/update-category.php");
    
                            die();
                        }

                         // Remove current image if it exists
                        if($current_image != ''){

                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
        
                            if($remove == false){
                                $_SESSION["remove"] = "<div class='error'>Failed to remove current image</div>";
        
                                header("location:".SITEURL."admin/manage-category.php");
        
                                die();
                            }
                        }


                    }else{
                        $image_name = $current_image;
                    }

                }else{
                    $image_name = $current_image;
                }

                $sql2 = "UPDATE tbl_category SET 
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id = $id";
                
                $res2 = mysqli_query($conn , $sql2);

                if($res2 == TRUE){

                    $_SESSION["update"] = "<div class = 'success'>Category Update Successfully</div>";

                    header("location:".SITEURL."admin/manage-category.php");

                }else{

                    $_SESSION["update"] = "<div class = 'error'>Category Update Unsuccessfully</div>";

                    header("location:".SITEURL."admin/manage-category.php");
                }

            }
        ?>
    </div>
</div>

<?php include("partials/footer.php") ?>