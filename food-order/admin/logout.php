<?php 
    //include constants for SITEURL
    include("../config/constants.php");

    // Destroy SESSION
    session_destroy();

    header("location:".SITEURL."admin/login.php");

?>