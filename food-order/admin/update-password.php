<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <?php 
            if(isset($_GET["id"])){
                $id = $_GET["id"];
            }
        ?>
        <form action="" method="post">

            <table class="tbl-full">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password"> 
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary" style="cursor:pointer;">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST["submit"])){
        // 1.Get data from Form
        $id = $_POST["id"];
        $current_password = $_POST["current_password"]; // ham md5 dung de ma hoa mat khau
        $new_password = $_POST["new_password"];
        $confirm_password = $_POST["confirm_password"];


        // 2.Check if ID and current password is exists or not already
        $sql = "SELECT * FROM tbl_admin WHERE id = $id AND password = '$current_password'";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){
            $count = mysqli_num_rows($res);

            if($count == 1){
                // 3.Check if new pass = confirm_password
                if($new_password == $confirm_password){
                    // 4.Update password
                    $sql2 = "UPDATE tbl_admin SET
                    password = '$new_password' WHERE id = $id";

                    $res2 = mysqli_query($conn , $sql2);

                    if($res2 == TRUE){
                        $_SESSION["change_pwd"] = "<div class='success'> Change password successfully</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }else{
                        $_SESSION["change_pwd"] = "<div class='error'> Change password unsuccessfully</div>";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }

                }else{
                    $_SESSION["pwd_not_match"] = "<div class='error'> Not match password </div>";
                    header("location:".SITEURL."admin/manage-admin.php");
                }

            }else{
                $_SESSION["user_not_found"] = "<div class='error'> User not found </div>";
                header("location:".SITEURL."admin/manage-admin.php");
            }
        } 
    }
?>

<?php include("partials/footer.php") ?>