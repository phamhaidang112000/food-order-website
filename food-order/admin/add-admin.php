<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

         <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']); // remove session variable
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-full">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your full name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Enter your password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary" style="cursor:pointer;">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include("partials/footer.php") ?>

<?php 
    // Process the value from Form and Save it in Database


    // Check if submit button is clicked or not
    if(isset($_POST['submit'])){

        // 1. Get data from FORM
        $fullname = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 2. SQL Query to save data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$fullname',
            username = '$username',
            password = '$password'
        ";


        //3. Execute SQL Query and Save Data to Database
        $res = mysqli_query($conn,$sql) or die(mysqli_error());


        //4. Check if query is executed successfully
        if($res == TRUE ){
            // Create session variable to show message
            $_SESSION['add'] = "<div class ='success'>Admin added successfully</div>";

            // Redirect to manage admin page
            header("location:".SITEURL."admin/manage-admin.php");

        }else{
            $_SESSION['add'] = "<div class ='error'>Admin added unsuccessfully</div>";
             // Redirect to manage add admin page
            header("location:".SITEURL."admin/add-admin.php");
        }




    }
?>