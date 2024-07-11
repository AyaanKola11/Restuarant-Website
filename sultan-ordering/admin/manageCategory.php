<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br />
        <br />

        <?php

        if (isset($_SESSION['add'])) {
            // echo $_SESSION['add'];
            echo '<div id="session-message-addCatg">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['remove'])) {
            //echo $_SESSION['remove'];
            echo '<div id="session-message-remove">' . $_SESSION['remove'] . '</div>';

            unset($_SESSION['remove']);
        }

        if (isset($_SESSION['delete'])) {
           // echo $_SESSION['delete'];
            echo '<div id="session-message-delete">' . $_SESSION['delete'] . '</div>';

            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['no-catg-found'])) {
            // echo $_SESSION['delete'];
             echo '<div id="session-message-noCatgFound">' . $_SESSION['no-catg-found'] . '</div>';
 
             unset($_SESSION['no-catg-found']);
         }


        if (isset($_SESSION['update'])) {
            // echo $_SESSION['delete'];
             echo '<div id="session-message-update">' . $_SESSION['update'] . '</div>';
 
             unset($_SESSION['update']);
         }

         if (isset($_SESSION['upload'])) {
            // echo $_SESSION['delete'];
             echo '<div id="session-message-upload">' . $_SESSION['upload'] . '</div>';
 
             unset($_SESSION['upload']);
         }

         if(isset($_SESSION['removeFailed']))
         {
            //echo $_SESSION['removeFailed'];
            echo '<div id="session-message-removeFailed">' . $_SESSION['removeFailed'] . '</div>';

            unset($_SESSION['removeFailed']);
         }

        ?>
        

        <script src="script.js"></script>
        <br><br>

        <!-- Button for adding the Admin -->
        <a href="<?php echo HOMEURL; ?>admin/addCategory.php" class="btn-sec">Add category</a>

        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>Category Id</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php

            //SQL query gets all categories from database
            $sql = "SELECT * FROM category";

            //Execution of SQL query
            $res = mysqli_query($conn, $sql);

            //Counts rows
            $count = mysqli_num_rows($res);

            //creates a serial number variable
            $sn = 1;

            //Checks if theres data in the database
            if ($count > 0)
             {

                //Data is available in database
                //Gets data and displays
                while ($row = mysqli_fetch_assoc($res)) 
                {

                    $categoryId = $row["categoryId"];
                    $title = $row["title"];
                    $imageName = $row['imageName'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++; ?>.</td>
                        <td><?php echo $title; ?></td>

                        <td>

                            <?php 
                                //checks if image is available in available or not
                                if($imageName!="")
                                {
                                    //Displays image
                                    ?>
                                    
                                    <img src="<?php echo HOMEURL; ?>images/categories/<?php echo $imageName; ?>" width="85px">
                                    
                                    <?php
                                }
                                else
                                {

                                    echo "<div class='error'>Image was not added</div>";
                                   // echo "<div class='error'>Image Name is empty: '$imageName'</div>";
                                    // Add this line for debugging
                                }
                            ?>

                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/updateCategory.php?categoryId=<?php echo $categoryId; ?>" class="btn-sec">Update Category</a>
                            <a href="<?php echo HOMEURL; ?>admin/deleteCategory.php?categoryId=<?php echo $categoryId; ?>&imageName=<?php echo $imageName;?>" class="btn-red">Delete Category</a>
                        </td>
                    </tr>

                    <?php
                }

            } else {

                //Data is not available in database
                //Display message inside 
                ?>

                <tr>
                    <td colspan="6">
                        <div class="error">No category added</div>
                    </td>
                </tr>

                <?php

            }

            ?>




        </table>
    </div>


</div>

<?php include ('partials/footer.php'); ?>