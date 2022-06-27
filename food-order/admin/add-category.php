<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
         <h1>Add Category</h1>

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

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary" style="cursor:pointer;">
                    </td>
                </tr>

            </table>
        </form>

        <?php 
            if(isset($_POST["submit"])){

                $title = $_POST["title"];

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


                if(isset($_FILES["image"]["name"])){
                    // To upload image we need image name , source path , destination path
                    $image_name = $_FILES["image"]["name"];

                    if($image_name != ''){
                        
                        // Auto rename file 
                        // Get extentsion of our image
                        $ext = end(explode('.',$image_name)); //hàm end đưa con trỏ về vị trí cuối mảng , hàm explode trả về mảng các từ tách theo ký tự quy định
    
                        $image_name = "Food_Category_".rand(000,999).".".$ext;
    
                        
    
                        $source_path = $_FILES["image"]["tmp_name"];
                        $destination_path = "../images/category/".$image_name;
    
                        // Finally upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
    
                        // Check whether image is uploaded or not
                        if($upload == false){
                            $_SESSION["upload"] = "<div class='error'> Failed to upload the image </div>";
    
                            header("location:".SITEURL."admin/add-category.php");
    
                            die();
                        }

                    }


                }else{

                }

                $sql = "INSERT INTO tbl_category SET 
                title = '$title',
                image_name = '$image_name',
                featured = '$featured',
                active = '$active'
                ";

                $res = mysqli_query($conn, $sql);

                if($res == TRUE){
                    $_SESSION['add'] = "<div class ='success'>Category added successfully</div>";

                    // Redirect to manage admin page
                    header("location:".SITEURL."admin/manage-category.php");

                }else{
                    $_SESSION['add'] = "<div class ='error'>Category added unsuccessfully</div>";

                    // Redirect to manage admin page
                    header("location:".SITEURL."admin/add-category.php");
                }

            }
        ?>
    </div>
</div>

<?php include("partials/footer.php"); ?>