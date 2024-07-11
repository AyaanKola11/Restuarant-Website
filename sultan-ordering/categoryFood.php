<?php include ('partials-frontend/menu.php'); ?>

<?php

//checks if the ID is passed or not 
if (isset($_GET['categoryId'])) {

    $categoryId = $_GET['categoryId'];
    //Gets the category title that matches with its ID
    $sql = "SELECT title FROM category WHERE categoryId=$categoryId";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Gets the value from database
    $row = mysqli_fetch_assoc($res);

    //gets the title
    $title = $row['title'];

} else {

    header('location:' . HOMEURL);

}

?>


<!-- Search Section Starts Here -->
<section class="food-search text-center">
    <div class="SearchContainer">

        <h2>Items in <a href="#" class="text-white">"<?php echo $title; ?>"</a></h2>

    </div>
</section>
<!-- Search Section Ends Here -->


<!-- food menu Section starts here -->
<section class="food-menu">
    <div class="container">
        <h2 class="explorefood text-center">• Explore Our Food •</h2>

        <?php

        $sql2 = "SELECT * FROM meal WHERE categoryId=$categoryId";

        //execute query 
        $res2 = mysqli_query($conn, $sql2);

        //count rows
        $count2 = mysqli_num_rows($res2);

        if ($count2 > 0) {

            while ($row2 = mysqli_fetch_assoc($res2)) {

                $mealId = $row2['mealId'];
                $title = $row2["title"];
                $price = $row2["price"];
                $description = $row2["description"];
                $imageName = $row2["imageName"];
                ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                            if($imageName==""){

                                echo "<div class='error'>Image is not available</div>";

                            }else{

                                ?>
                                 <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>" alt="Chicken" class="img-responsive img-curve">
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

                        <a href="<?php echo HOMEURL; ?>foodOrder.php?mealId=<?php echo $mealId; ?>" class="btn">Place Order</a>
                    </div>
                </div>

                <?php

            }

        } else {

            echo "<div class='error'>Item is not available</div>";

        }

        ?>

        <div class="clearfix"></div>
    </div>
</section>
<!-- food menu Section starts here -->

<?php include ('partials-frontend/footer.php'); ?>