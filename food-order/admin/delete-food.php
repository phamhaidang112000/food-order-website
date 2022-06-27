<?php 
    include('../config/constants.php');

    // 1.Get ID to delete category
    if(isset($_GET["id"]) && isset($_GET["image_name"])){

        $id = $_GET["id"];
        $image_name = $_GET["image_name"];


        //Remove the physical image is available
        if($image_name != ''){
            $path = "../images/food/".$image_name;
            $remove = unlink($path); //Hàm unlink() dùng để xóa một tập tin được lưu trên máy chủ của bạn.

            if($remove == false){
                $_SESSION["remove"] = "<div class='error'>Failed to remove food image</div>";

                header("location:".SITEURL."admin/manage-food.php");

                die();
            }
        }

        // Create query to delete category
        $sql = "DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
            
            $_SESSION['delete'] = "<div class ='success'>Food deleted successfully</div>";

            
            header("location:".SITEURL."admin/manage-food.php");

        }else{
            
            $_SESSION['delete'] = "<div class ='error'>Food deleted unsuccessfully</div>";

        
            header("location:".SITEURL."admin/manage-food.php");

        }

    }else{
        header("location:".SITEURL."admin/manage-food.php");
    }
  
?>