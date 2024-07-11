<?php include ('partials-frontend/menu.php'); ?>

<!-- Search Section Starts Here -->
<!-- <section class="food-search text-center">
    <div class="SearchContainer">
      <form action="">
        <input type="search" name="search" placeholder="Search for meal" />
        <input type="submit" name="submit" value="Search" class="SearchBtn" />
      </form>
    </div>
  </section> -->
<!-- Search Section Ends Here -->


<!-- food menu Section starts here -->
<section class="food-menu">
  <div class="container">
    <h2 class="explorefood text-center">• Explore our food menu •</h2>

    <?php

    //Displays the items that are active 
    $sql = "SELECT * FROM meal WHERE active='Yes'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    //checks if the meal/item is available
    if ($count > 0) {
      while ($row = mysqli_fetch_assoc($res)) {

        //get values
        $mealId = $row['mealId'];
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $imageName = $row['imageName'];

        ?>

        <div class="food-menu-box">
          <div class="food-menu-img">
            <?php

            //check if the image exists
            if ($imageName == '') {

              //image not avaialble
              echo "<div class='error'>Image is not available</div>";

            } else {

              //Image avaialble
              ?>
              <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>" alt="beef pide"
                class="img-responsive img-curve" />
              <?php

            }


            ?>

          </div>

          <div class="food-menu-desc">
            <h4><?php echo $title; ?></h4>
            <p class="food-price">R<?php echo $price; ?></p>
            <p class="food-details">
              <?php echo $description; ?>
              <!-- 100g beef cubes, cubed tomato, onion and peppers served on crusty
              a flat bread -->
            </p>
            <br />

            <a href="<?php echo HOMEURL; ?>foodOrder.php?mealId=<?php echo $mealId; ?>" class="btn">Place Order</a>
          </div>
        </div>

        <?php

      }
    } else {
      //Item not available
      echo "div class='error'>Item not found</div>";
    }
    ?>


    <div class="clearfix"></div>
  </div>
</section>
<!-- food menu Section ends here -->

<?php include ('partials-frontend/footer.php'); ?>