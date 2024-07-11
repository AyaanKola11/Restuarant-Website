<?php include ('partials-frontend/menu.php'); ?>

<!-- Search Section Starts Here -->
<section class="food-search text-center">
  <div class="SearchContainer">
    <form action="<?php echo HOMEURL; ?>foodSearch.php" method="POST">
      <input type="search" name="search" placeholder="Search for meal" />
      <input type="submit" name="submit" value="Search" class="SearchBtn" />
    </form>
  </div>
</section>
<!-- Search Section Ends Here -->

<?php
  if(isset($_SESSION['order'])){

    //echo $_SESSION['order'];
    echo '<div id="session-message-orderMsg">' . $_SESSION['order'] . '</div>';
    unset($_SESSION['order']);

  }
?>
<script src="script2.js"></script>


<!-- Categrories Section Starts Here -->
<section class="categories">
  <div class="container">
    <h2 class="categ text-center">• Categories •</h2>

    <?php
    //sql query to show categories
    $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";

    //Executes query
    $res = mysqli_query($conn, $sql);

    //Counts rows if the category is there or not
    $count = mysqli_num_rows($res);

    if ($count > 0) {

      while ($row = mysqli_fetch_assoc($res)) {
        //Gets values
    
        $categoryId = $row['categoryId'];
        $title = $row['title'];
        $imageName = $row['imageName'];

        ?>

        <a href="<?php echo HOMEURL; ?>categoryFood.php?categoryId=<?php echo $categoryId; ?>">
          <div class="box-3 float-container">
            <?php
            //checks if the image is there or not
            if ($imageName == "") {
              //Shows message
        
              echo "<div class='error'>The image is not available</div>";

            } else {
              //Image is available
              ?>
              <img src="<?php echo HOMEURL; ?>images/categories/<?php echo $imageName; ?>" alt="Falafel" class="img-curve" />
              <?php
            }
            ?>

            <h3 class="fcateg float-text"><?php echo $title; ?></h3>
          </div>
        </a>

        <?php
      }

    } else {

    }


    ?>

    <div class="clearfix"></div>
  </div>
  </a>
</section>
<!-- Categrories Section Ends Here -->



<!-- food menu Section starts here -->
<section class="food-menu">
  <div class="container">
    <h2 class="explorefood text-center">• Explore Our Food •</h2>

    <?php

    //Gets the food from the database
    //SQL query
    
    $sql2 = "SELECT * FROM meal WHERE active='Yes' AND featured='Yes' LIMIT 6";

    //Executes the query
    $res2 = mysqli_query($conn, $sql2);

    //counts rows
    $count2 = mysqli_num_rows($res2);

    //checks if the food is there
    if ($count2 > 0) {

      while ($row = mysqli_fetch_assoc($res2)) {

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
              <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $imageName; ?>" alt="beef pide" class="img-responsive img-curve" />
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

      echo "<div class='error'>Food was not found</div>";
    }


    ?>





    <div class="clearfix"></div>
  </div>
</section>
<!-- food menu Section starts here -->

<?php include ('partials-frontend/footer.php'); ?>
