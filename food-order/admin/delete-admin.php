<?php 
    include('../config/constants.php');

    // 1.Get ID to delete Admin
    $id = $_GET['id'];

    // 2.Create query to delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res == TRUE){
        // Create session variable to display message
        $_SESSION['delete'] = "<div class ='success'>Admin delete successfully</div>";

        // Redirect to admin page
        header("location:".SITEURL."admin/manage-admin.php");

    }else{
         // Create session variable to display message
        $_SESSION['delete'] = "<div class ='error'>Admin delete unsuccessfully</div>";

        // Redirect to admin page
        header("location:".SITEURL."admin/manage-admin.php");

    }

    // 3, Redirect to admin page
?>