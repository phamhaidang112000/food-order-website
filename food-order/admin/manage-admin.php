

       
        <?php include("partials/menu.php"); ?>

        <!-- Main content section start -->
        <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE ADMIN</h1>
                <br>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];
                        unset($_SESSION['add']); // remove session variable
                    }


                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']); // remove session variable
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']); // remove session variable
                    }

                    if(isset($_SESSION['user_not_found'])){
                        echo $_SESSION['user_not_found'];
                        unset($_SESSION['user_not_found']); // remove session variable
                    }

                    if(isset($_SESSION['pwd_not_match'])){
                        echo $_SESSION['pwd_not_match'];
                        unset($_SESSION['pwd_not_match']); // remove session variable
                    }

                    if(isset($_SESSION['change_pwd'])){
                        echo $_SESSION['change_pwd'];
                        unset($_SESSION['change_pwd']); // remove session variable
                    }
                ?>
                <br>

                <!-- Button Add Admin -->
                <a href="add-admin.php" class="btn-primary">Add admin</a>
               
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        $stt = 1; //Count record
                        //Select all admin
                        $sql = "SELECT * FROM tbl_admin";
                        $res = mysqli_query($conn, $sql);

                        if($res == TRUE){

                            //Count row to check where we have data or not
                            $row = mysqli_num_rows($res);

                            if($row > 0){

                                //Using while loop to get all data from database
                                while($row = mysqli_fetch_assoc($res)){

                                    $id = $row['id'];
                                    $fullname = $row['full_name'];
                                    $username = $row['username'];


                                    //Display values in the table
                                    ?>

                                    <tr>
                                        <td><?php echo $stt++; ?></td>
                                        <td><?php echo $fullname; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }

                            }else{
                                echo "No data to display";
                            }
                        }
                    ?>
                </table>

            </div>
        </div>
        <!-- Main content section end -->


        <?php include("partials/footer.php") ?>

   