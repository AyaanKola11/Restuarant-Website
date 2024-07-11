<?php include ('partials/menu.php'); ?>

<!-- Main Content Section Starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Dashboard</h1>
        <br><br>

        <?php
        if (isset($_SESSION['login'])) {
            // echo $_SESSION['login'];
            echo '<div id="session-message-lgin">' . $_SESSION['login'] . '</div>';
            unset($_SESSION['login']);
        }
        ?>
        <br><br>


        <div class="col-4 text-center">

            <?php
            $sql = "SELECT * FROM category";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            ?>

            <h1><?php echo $count; ?></h1>
            <br />
            Categories
        </div>

        <div class="col-4 text-center">

            <?php

            $sql2 = "SELECT * FROM meal";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            ?>

            <h1><?php echo $count2; ?></h1>
            <br />
            Foods
        </div>

        <div class="col-4 text-center">

            <?php

            $sql3 = "SELECT * FROM mealorder";

            $res3 = mysqli_query($conn, $sql3);

            $count3 = mysqli_num_rows($res3);

            ?>


            <h1><?php echo $count3; ?></h1>
            <br />
            Total Orders
        </div>

        <div class="col-4 text-center">

            <?php

            //Aggregate function in sql
            $sql4 = "SELECT SUM(totalAmount) AS Total FROM mealorder WHERE status='Delivered'";

            $res4 = mysqli_query($conn, $sql4);

            //get value
            $row4 = mysqli_fetch_assoc($res4);

            //gets total revenue
            $totalRevenue = $row4['Total'];

            ?>

            <h1>R<?php echo $totalRevenue; ?></h1>
            <br />
            Revenue Generated
        </div>

        <div class="clearfix"></div>

    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>


<!-- Main Content Section Ends here -->



<?php include ('partials/footer.php') ?>
<script src="script.js"></script>