<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br>
        <br>

        <?php

        if (isset($_SESSION['upload'])) {
            // echo $_SESSION['add'];
            echo '<div id="session-message-uploadFood">' . $_SESSION['upload'] . '</div>';
            unset($_SESSION['upload']);
        }

        ?>
        <script src="script.js"></script>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-full">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the meal">
                    </td>

                </tr>

                <tr>
                    <td>Decription: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"
                            placeholder="Description of the meal"></textarea>
                    </td>

                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                            //Displays categories from database
                            //gets all active categories from database
                            $sql = "SELECT * FROM category WHERE active='Yes'";

                            //Executes query
                            $res = mysqli_query($conn, $sql);

                            //counts the rows to check if there is catgeories available
                            $count = mysqli_num_rows($res);

                            //If count is > 0, then there is catgeories available
                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {

                                    //gets details of catgeories
                                    $categoryId = $row['categoryId'];
                                    $title = $row['title'];

                                    ?>

                                    <option value="<?php echo $categoryId; ?>"><?php echo $title; ?></option>


                                    <?php
                                }

                            } else {
                                ?>
                                <option value="0">No category found</option>
                                <?php
                            }
                            ?>



                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Meal" class="btn-sec">
                    </td>
                </tr>


            </table>

        </form>


        <?php

        //Checks if button is clicked
        if (isset($_POST['submit'])) {
            //adds food into database
            //echo "Clicked";
        
            //1. Gets data from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check if featured and active is checked
            if (isset($_POST['featured'])) {

                $featured = $_POST['featured'];

            } else {

                $featured = "No"; //Sets default value
        
            }

            if (isset($_POST['active'])) {

                $active = $_POST['active'];

            } else {

                $active = "No";
            }


            //2. Upload Image when clicked
            //Checks if selected image is clicked and upload the image only if the image is clicked
            if (isset($_FILES['image']['name'])) {
                //Get details of selected image
                $imageName = $_FILES['image']['name'];

                //Checks if the image is selected
                if ($imageName != "") {
                    //Rename Image
                    //Gets extension of selected image
                    $temp = explode('.', $imageName);
                    $ext = end($temp);

                    //Creates new name for the image
                    $imageName = "Meal-Name-" . rand(0000, 9999) . "." . $ext;

                    //upload the image
                    //Source path and Destination path
        
                    //Source path is the location of the image
                    $src = $_FILES['image']['tmp_name'];

                    //Destination Path 
                    $dest = "../images/Meal/" . $imageName;

                    //Uploads the meal image
                    $upload = move_uploaded_file($src, $dest);

                    //Checks if the image is uploaded
                    if ($upload == FALSE) {

                        //Redirects to add food page with a message
                        $_SESSION['upload'] = "<div class='error'>Image failed to be uploaded</div>";
                        header('location:' . HOMEURL . 'admin/addFood.php');
                        //Stops process
                        die();
                    }



                }
            } else {

                $imageName = ""; //Sets default value as blank
        
            }

            //3. Insert into the database
        
            //SQL query to save or add meals 
            //
            $sql2 = "INSERT INTO meal SET
                 title = '$title',
                 description = '$description',
                 price = '$price',
                 imageName = '$imageName',
                 categoryId = '$categoryId',
                 featured = '$featured',
                 active = '$active'
                 
                 ";


            //Execution of the query 
            $res2 = mysqli_query($conn, $sql2);

            //check if data is inserted or not 
            //Redirect with message to manage food page
        
            if ($res2 == TRUE) {

                $_SESSION["add"] = "<div class='allgood'>Meal was added successfully</div>";
                header('location:' . HOMEURL . 'admin/manageFood.php');

            } else {

                $_SESSION["add"] = "<div class='error'>Failed to add the meal</div>";
                header('location:' . HOMEURL . 'admin/manageFood.php');


            }

            //4. Redirect with message to manage food page
        
            //
        }

        ?>

    </div>
</div>
<?php include ('partials/footer.php'); ?>