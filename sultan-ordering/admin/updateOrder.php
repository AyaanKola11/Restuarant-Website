<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br><br>


        <?php 

            //check if the Id is set or not
            if(isset($_GET['orderId'])){

                $orderId = $_GET['orderId'];

                //gets other details based on the orderId
                //sql query to get the order details
                $sql = "SELECT * FROM mealorder WHERE orderId = $orderId";

                $res = mysqli_query($conn, $sql);

                //counts the number of rows in the mealOrder table
                $count = mysqli_num_rows($res);

                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $mealName = $row['mealName'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $status = $row['status'];
                    $customerName = $row['customerName'];
                    $customerContact = $row['customerContact'];
                    $customerEmail = $row['customerEmail'];
                    $customerAddress = $row['customerAddress'];

                }else{
                    //redirects to Manage Order
                    header('location:'.HOMEURL.'admin/manageOrder.php');

                }

            }else{
                header('location:'.HOMEURL.'admin/manageOrder.php');
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-full">
                <tr>
                    <td>Meal name</td>
                    <td><b> <?php echo $mealName; ?> </b></td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>
                        <b>R <?php echo $price; ?></b>
                    </td>

                </tr>

                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $quantity; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered"){echo "selected";} ?>value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery"){echo "selected";} ?>value="On delivery">On Delivery</option>
                            <option <?php if($status == "Delivered"){echo "selected";} ?>value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled"){echo "selected";} ?>value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customerName" value="<?php echo $customerName; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customerContact" value="<?php echo $customerContact; ?>">
                    </td>
                </tr>

                
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customerEmail" value="<?php echo $customerEmail; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customerAddress" cols="30" rows="5"><?php echo $customerAddress; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="orderId" value="<?php echo $orderId; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update order" class="btn-primary">
                    </td>
                </tr>



            </table>
        </form>

        <?php

            //checks if the button was clicked 
            if(isset($_POST['submit'])){
               // echo "Clicked";
               //gets values from the form 
               $orderId = $_POST['orderId'];
               $price = $_POST['price'];
               $quantity = $_POST['quantity'];
               $totalAmount = $price * $quantity;
               $status = $_POST['status'];
               $customerName = $_POST['customerName'];
               $customerContact = $_POST['customerContact'];
               $customerEmail = $_POST['customerEmail'];
               $customerAddress = $_POST['customerAddress'];

               //updates values
               $sql2 = "UPDATE mealorder SET 
                    quantity = $quantity,
                    totalAmount = $totalAmount,
                    status = '$status',
                    customerName = '$customerName',
                    customerContact = '$customerContact',
                    customerEmail = '$customerEmail',
                    customerAddress = '$customerAddress'
                    WHERE orderId = $orderId
               
               ";

               $res2 = mysqli_query($conn, $sql2);
               //redirect to manage order with a message

               if($res2 == TRUE){

                    $_SESSION['update'] = "<div class='allgood'>Order was updated successfully</div>";
                    header('location:'.HOMEURL.'admin/manageOrder.php');

               }else{

                    
                $_SESSION['update'] = "<div class='error'>Order failed to update</div>";
                header('location:'.HOMEURL.'admin/manageOrder.php');

               }

            }

        ?>


    </div>
</div>

<?php include ('partials/footer.php'); ?>