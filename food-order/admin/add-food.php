<?php include("partials/menu.php"); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

        <?php 

            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove session variable
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']); // remove session variable
            }
        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of food">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
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
                                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";

                                $res = mysqli_query($conn , $sql);

                                $count  = mysqli_num_rows($res);

                                if($count > 0){
                                    while($row = mysqli_fetch_assoc($res)){
                                        $category_id = $row['id'];
                                        $category_title = $row["title"];
                                        
                                        ?>

                                        <option value="<?php echo $category_id ?>"><?php echo $category_title ?></option>


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
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                 <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary" style="cursor:pointer;">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){

                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                 if(isset($_FILES["image"]["name"])){
                    // To upload image we need image name , source path , destination path
                    $image_name = $_FILES["image"]["name"];

                    if($image_name != ''){
                        
                        // Auto rename file 
                        // Get extentsion of our image
                        $ext = end(explode('.',$image_name)); //hàm end đưa con trỏ về vị trí cuối mảng , hàm explode trả về mảng các từ tách theo ký tự quy định
    
                        $image_name = "Food_Name_".rand(0000,9999).".".$ext;
    
                        
    
                        $source_path = $_FILES["image"]["tmp_name"];
                        $destination_path = "../images/food/".$image_name;
    
                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
    
                        // Check whether image is uploaded or not
                        if($upload == false){
                            $_SESSION["upload"] = "<div class='error'> Failed to upload the image </div>";
    
                            header("location:".SITEURL."admin/add-food.php");
    
                            die();
                        }

                    }


                }else{
                     
                    $_SESSION["upload"] = "<div class='error'> Failed to upload the image </div>";
    
                    header("location:".SITEURL."admin/add-food.php");
                }


                if(isset($_POST["featured"])){
                    $featured = $_POST["featured"];
                }else{
                    $featured = "No";
                }


                if(isset($_POST["active"])){
                    $active = $_POST["active"];
                }else{
                    $active = "No";
                }

                $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'";

                $res2 = mysqli_query($conn , $sql2);

                if($res2 == TRUE){

                    $_SESSION['add'] = "<div class ='success'>Food added successfully</div>";

                    // Redirect to manage admin page
                    header("location:".SITEURL."admin/manage-food.php");


                }else{

                    $_SESSION['add'] = "<div class ='error'>Food added unsuccessfully: $sql2</div>";

                    // Redirect to manage admin page
                    header("location:".SITEURL."admin/add-food.php");

                }



            }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>