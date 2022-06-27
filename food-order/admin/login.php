<?php include("../config/constants.php"); ?>
<html>
    <head>
        <title>Login - Food Order Website</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1><br>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']); // remove session variable
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']); // remove session variable
                }

            ?>
            <br>

            <form action="" method="post" class= "text-center">
                Username: <br><br>  
                <input type="text" name="username" placeholder="Username"> <br><br>
                Password: <br> 
                <input type="password" name="password" placeholder="Password"> <br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"> 
            </form>

        </div>
        <?php 
            if(isset($_POST["submit"])){
                $username = mysqli_real_escape_string($conn , $_POST["username"]);
                $password = mysqli_real_escape_string($conn , $_POST["password"]);

                $sql = "SELECT * FROM tbl_admin where username='$username' and password='$password'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count == 1){

                    $_SESSION["login"] = "<div class ='success'>Login successfully</div>";
                    $_SESSION["user"] = $username; //To check whether user is logged in or not and logout will unset it

                    header("location:".SITEURL."admin/");

                }else{

                    $_SESSION["login"] = "<div class ='error'>Username or password is correct</div>";

                    header("location:".SITEURL."admin/login.php");
                }
            }
        ?>
    </body>
</html>

