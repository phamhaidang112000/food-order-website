<?php 
    //Authorization - Access control
    //Check whether the user is logged in or not
    if(!isset($_SESSION["user"])){
        $_SESSION["no-login-message"] = "<div class='error'>Please login to access</div>";
        header("location:".SITEURL."admin/login.php");
        
    }
?>