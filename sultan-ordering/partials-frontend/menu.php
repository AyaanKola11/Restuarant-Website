<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <!--Important to make website responsive-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sultan Restuarant Website</title>

    <!-- Link to the CSS file-->
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
      <div class="container">
        <div class="Sultanlogo">
          <img
            src="images/newSultanLogo (1).png"
            alt="Restuarant Logo"
            class="img-responsive"
          />
        </div>

        <div class="menu text-right">
          <ul>
            <li>
              <a href="<?php echo HOMEURL; ?>">Home</a>
            </li>
            <li>
              <a href="<?php echo HOMEURL; ?>AboutPage.php">About</a>
            </li>
            <li>
              <a href="<?php echo HOMEURL; ?>foodMenu.php">Menu</a>
            </li>
            <li>
              <a href="<?php echo HOMEURL; ?>contactPage.php">Contact</a>
            </li>
          </ul>
        </div>

        <div class="clearfix"></div>
      </div>
    </section>
    <!-- Navbar Section Ends Here -->