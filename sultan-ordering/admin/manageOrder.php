<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br />
        <br />
        <br />

        <?php

        if(isset($_SESSION['update'])){
           
            echo '<div id="session-message-updateMng">' . $_SESSION['update'] . '</div>';
            unset($_SESSION['update']);

        }

         ?>
           <script src="script.js"></script>

         <br><br>

        <table class="tbl-full">
            <tr>
                <th class="orderId">OrderId</th>
                <th class="mealName">Item</th>
                <th class="price">price</th>
                <th class="quantity">quantity</th>
                <th class="totalAmount">total</th>
                <th class="orderDate">orderDate</th>
                <th class="status">status</th>
                <th>Name</th>
                <th class="Contact">Contact</th>
                <th class="Email">Email</th>
                <th class="Address">Address</th>
                <th class="Actions">Actions</th>

            </tr>

            <?php

            //gets orders from the database
            $sql = "SELECT * FROM mealorder ORDER BY orderId DESC"; //Displaysl last order first

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1; 

            if ($count > 0) {

                while ($row = mysqli_fetch_assoc($res)) {

                    //Get all order details
                    $orderId = $row['orderId'];
                    $mealName = $row['mealName'];
                    $price = $row['price'];
                    $quantity = $row['quantity'];
                    $totalAmount = $row['totalAmount'];
                    $orderDate = $row['orderDate'];
                    $status = $row['status'];
                    $customerName = $row['customerName'];
                    $customerContact = $row['customerContact'];
                    $customerEmail = $row['customerEmail'];
                    $customerAddress = $row['customerAddress'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $mealName; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td><?php echo $totalAmount; ?></td>
                        <td><?php echo $orderDate; ?></td>

                        <td>
                            <?php
                                //status of order
                                if($status == "Ordered"){
                                    echo "<label>$status</label>";

                                }elseif($status == "On delivery"){
                                    echo "<label style='color: orange;'>$status</label>";

                                }elseif($status == "Delivered"){
                                    echo "<label style='color: green;'>$status</label>";

                                }elseif($status == "Cancelled"){
                                    echo "<label style='color: red;'>$status</label>";

                                }
                            
                            ?>
                        </td>

                        <td><?php echo $customerName; ?></td>
                        <td><?php echo $customerContact; ?></td>
                        <td><?php echo $customerEmail; ?></td>
                        <td><?php echo $customerAddress; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/updateOrder.php?orderId=<?php echo $orderId; ?>" class="btn-primary-update">Update</a>

                        </td>
                    </tr>


                    <?php

                }

            } else {

                echo "<tr><td colspan='12' class='error'>Orders are not available</td></tr>";

            }

            ?>


        </table>
    </div>


</div>

<?php include ('partials/footer.php'); ?>