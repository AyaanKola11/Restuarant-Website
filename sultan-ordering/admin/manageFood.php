<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food/Drinks</h1>

        <br />
        <br />

        <!-- Button for adding the Admin -->
        <a href="<?php echo HOMEURL; ?>admin/addFood.php" class="btn-sec">Add Food/Drinks</a>

        <br />
        <br />
        <br />
        <br />

        <?php
        if (isset($_SESSION['add'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-addMeal">' . $_SESSION['add'] . '</div>';

            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-deleteMeal">' . $_SESSION['delete'] . '</div>';

            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-uploadFood">' . $_SESSION['upload'] . '</div>';

            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-unauthorize">' . $_SESSION['unauthorize'] . '</div>';

            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['updateMeal'])) {
            //echo $_SESSION['add'];
            echo '<div id="message-updateMeal">' . $_SESSION['updateMeal'] . '</div>';

            unset($_SESSION['updateMeal']);
        }



        ?>
        <script src="script.js"></script>

        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>Meal Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //SQL query to get all food
            $sql = "SELECT * FROM meal";

            //Execution of the query
            $res = mysqli_query($conn, $sql);

            //counts the rows to see if there is food
            $count = mysqli_num_rows($res);

            //creates serial number variable and set default value as 1
            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    //gets the values from individual columns
                    $mealId = $row['mealId'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $imageName = $row['imageName'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td>R<?php echo $price; ?></td>
                        <td>
                            <?php 

                            //checks if the image exists
                            if($imageName == ""){

                                echo "<div class='error'>Image was not added</div>";

                            }
                            else{

                                ?>
                                <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>" width="85px">
                                <?php

                            }
                            
                            
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/updateFood.php?mealId=<?php echo $mealId; ?>" class="btn-sec">Update Item</a>
                            <a href="<?php echo HOMEURL; ?>admin/deleteFood.php?mealId=<?php echo $mealId; ?>&imageName=<?php echo $imageName; ?>" class="btn-red">Delete Item</a>
                        </td>
                    </tr>


                    <?php

                }
            } else {

                echo "<tr> <td colspan='7' class='error'> Food not added yet </td> </tr>";
            }


            ?>

            


        </table>
    </div>


</div>

<?php include ('partials/footer.php'); ?>