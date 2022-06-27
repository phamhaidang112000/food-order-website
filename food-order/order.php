<?php include("./partials-front/menu.php") ?>

<?php 
    if(isset($_GET["food_id"])){

        $food_id = $_GET["food_id"];

        $sql = "SELECT * FROM tbl_food WHERE id = $food_id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count == 1){

            $row = mysqli_fetch_assoc($res);

            $food_title = $row["title"];
            $food_price = $row["price"];
            $food_img_name = $row["image_name"];


        }else{
             header("location:".SITEURL);
            
        }

    }else{
        header("location:".SITEURL);
        
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="<?php echo SITEURL."images/food/".$food_img_name ?>" alt="Not found image" class="img-responsive img-curve">
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $food_title ?></h3>
                        <p class="food-price"><?php echo "$ ".$food_price ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 

                if(isset($_POST['submit'])){
                    $qty = $_POST['qty'];

                    $total = $food_price * $qty;

                    $order_date = date("Y-m-d h:i:sa");

                    $status = "Ordered"; // Ordered , On Delivery , Deliveryed , Cancelled

                    $customer_name = $_POST['full-name'];

                    $customer_contact = $_POST['contact'];

                    $customer_email = $_POST['email'];

                    $customer_address = $_POST['address'];

                    $sql2 = "INSERT INTO tbl_order SET
                    food = '$food_title',
                    price = $food_price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'";


                    $res2 = mysqli_query($conn ,$sql2);
                    
                    if($res2 == TRUE){

                        $_SESSION['order'] = "<div class = 'success text-center'>Order $food_title Successfully</div>";
                        header("location:".SITEURL);
                        

                    }else{

                        $_SESSION['order'] = "<div class = 'error text-center'>Order $food_title Unsuccessfully</div>";
                        header("location:".SITEURL);
                       
                    }
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include("./partials-front/footer.php") ?>