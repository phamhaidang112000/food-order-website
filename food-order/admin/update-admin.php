<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php 
            // 1.Get ID of Selected Admin
            $id = $_GET["id"];

            // 2.Create query to get data from id 
            $sql = "SELECT * FROM tbl_admin where id = $id";

            $res = mysqli_query($conn,$sql);

            if($res == TRUE){
                // Check where data is available or not
                $count = mysqli_num_rows($res);

                if($count == 1){

                    $row = mysqli_fetch_assoc($res);

                    $fullname = $row['full_name'];
                    $username = $row['username'];

                }else{

                     header("location:".SITEURL."admin/manage-admin.php");
                }
            }
        ?>


        <form action="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" value = "<?php echo $fullname; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value = "<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary" style="cursor:pointer;">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php 
    // Check where the submit button is clicked or not
    if(isset($_POST['submit'])){
        // Get all information to update the admin 
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET 
        full_name = '$fullname' ,
        username = '$username' 
        WHERE id = '$id'";

        $res = mysqli_query($conn, $sql);

        if($res == TRUE){

            $_SESSION['update'] = "<div class ='success'>Admin update successfully</div>";

            header("location:".SITEURL."admin/manage-admin.php");

        }else{

            $_SESSION['update'] = "<div class ='error'>Admin update unsuccessfully</div>";

            header("location:".SITEURL."admin/manage-admin.php");
        }
    } 
?>


<?php include("partials/footer.php") ?>

