<?php include('partials-frontend/menu.php'); ?>

<?php

//checks if the item id is set or not 
if(isset($_GET['mealId'])){
    
    //gets the item id and its details
    $mealId = $_GET['mealId'];

    $sql = "SELECT * FROM meal WHERE mealId = $mealId";

    $res = mysqli_query($conn, $sql);

    //counts rows
    $count = mysqli_num_rows($res);

    if($count == 1){
        //gets data from database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $imageName = $row['imageName'];

     }else{
        //Redirects to home page
        header('location:'.HOMEURL);

    }
}else{
    //Redirect to home page
    header('location:'.HOMEURL);
}


?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            
            <h2 class="text-center ">Fill this form to confirm your order</h2>

            <form action="" method="POST" class="order">
                <legend class="selectedFood">Selected Food</legend>
                <fieldset class="food-menu-order-selection">
                    

                    <div class="food-menu-img">
                        <?php

                        //checks if the image is available
                        if($imageName == ""){

                            echo "<div class='error'>Image is not available</div>";

                        }else{

                            ?>
                            <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>"  class="img-responsive img-curve">
                            <?php

                        }

                        ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3 class="foodOrderName"><?php echo $title; ?></h3>
                        <input type="hidden" name="mealName" value="<?php echo $title; ?>">

                        <p class="food-price">R<?php echo $price; ?></p>
                        <input type="hidden" name= "price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="quantity" class="input-responsive" value="1" title="Quantity" required>
                        
                    </div>

                </fieldset>

            </br>
            <legend class="deliveryDetails">Delivery Details</legend>
                <fieldset class="food-menu-order-selection">
                   
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Enter name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="Enter phone number" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="Enter email" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="Enter street address" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary submitBtn">

                   
                </fieldset>

            </form>
            
            <?php

            if(isset($_POST['submit'])){

                $mealName = $_POST['mealName'];
                $price = $_POST['price'];
                $quantity = $_POST['quantity'];

                $totalAmount = $price * $quantity;

                $orderDate = date("Y-m-d h:i:sa"); // Order date

                $status = "Ordered";

                $customerName = $_POST['full-name'];
                $customerContact = $_POST['contact'];
                $customerEmail = $_POST['email'];
                $customerAddress = $_POST['address'];

                //Saves order in the database
                $sql2 = "INSERT INTO mealorder SET
                    mealName = '$mealName',
                    price = $price,
                    quantity = $quantity,
                    totalAmount = $totalAmount,
                    orderDate = '$orderDate',
                    status = '$status',
                    customerName = '$customerName',
                    customerContact = '$customerContact',
                    customerEmail = '$customerEmail',
                    customerAddress = '$customerAddress'
                 ";

                //  echo $sql2; 
                //  die();

                 //executes query
                 $res2 = mysqli_query($conn, $sql2);

                 //checks if the query succeeded or not 
                 if($res2 == true){

                    //query executed
                    $_SESSION['order'] = "<div class='allgood text-center'>Order was successful</div>";
                    header('location:'.HOMEURL);

                 }else{

                    $_SESSION['order'] = "<div class='error text-center'>Order failed</div>";
                    header('location:'.HOMEURL);

                 }



            }


            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <?php include('partials-frontend/footer.php'); ?> 
    <script src="script.js"></script>