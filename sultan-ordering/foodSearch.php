<?php include ('partials-frontend/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <?php

        //Get search keyword
        $search = $_POST['search'];

        ?>

        <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

    </div>
</section>
<!-- fOOD search Section Ends Here -->


<!-- food menu Section starts here -->
<section class="food-menu">
    <div class="container">
        <h2 class="explorefood text-center">• Explore Our Food •</h2>

        <?php

        //sql query to get food based on whats search
        $sql = "SELECT * FROM meal WHERE title LIKE '%$search%' OR description LIKE '%$search%'";


        //executes the query
        $res = mysqli_query($conn, $sql);

        //counts rows
        $count = mysqli_num_rows($res);

        //checks if the meal is available
        if ($count > 0) {

            //food is available
            while ($row = mysqli_fetch_assoc($res)) {

                //gets the details
                $mealId = $row['mealId'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $imageName = $row['imageName'];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">

                        <?php
                        //check if image exists
                        if ($imageName == "") {

                            echo "<div class='error'>Image is not available</div>";


                        } else {
                            ?>
                            <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>" alt="Chicken Pide"
                                class="img-responsive img-curve">
                            <?php

                        }

                        ?>

                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">R<?php echo $price; ?></p>
                        <p class="food-details">
                            <?php echo $description; ?>
                        </p>
                        <br />

                        <a href="#" class="btn">Place Order</a>
                    </div>
                </div>

                <?php
            }

        } else {

            echo "<div class='error'>Item was not found</div>";

        }
        ?>


        <div class="clearfix"></div>
    </div>
</section>
<!-- food menu Section starts here -->

<?php include ('partials-frontend/footer.php') ?>