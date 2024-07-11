<?php include ('partials/menu.php'); ?>


<div class="main-content">

    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-addCatg">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['upload'])) {
            //echo $_SESSION['add'];
            echo '<div id="session-message-uploadMsg">' . $_SESSION['upload'] . '</div>';
            unset($_SESSION['upload']);
        }
        ?>

        <br>

        <!-- start of form for adding a category -->
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-b">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>


                <tr>

                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>


        </form>

        <!-- end of form for adding a category -->

        <?php
        //Checks if the submit button is clicked
        if (isset($_POST['submit'])) {

            //Gets the value from category form 
            $title = $_POST['title'];

            //Checks if button was clicked
            if (isset($_POST['featured'])) {
                //gets the value from form
                $featured = $_POST['featured'];

            } else {
                //Set the default value
                $featured = "No";
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No";
            }

            //This section will check if the image is selected and set a value for the image
            // print_r($_FILES['image']);
        
            //die(); //Breaks code
            if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
                //Upload image
                $imageName = $_FILES['image']['name'];

                //Auto Renaming of image
        
                //$ext = end(explode('.', $imageName));
                //Auto Renaming of image
                //Get image extension
                $temp = explode('.', $imageName);
                $ext = end($temp);


                //Renaming of image
                $imageName = "food_category_" . rand(000, 999) . '.' . $ext;


                $sourcePath = $_FILES['image']['tmp_name'];

                $destinationPath = "../images/categories/" . $imageName;

                //Uploads image
                $upload = move_uploaded_file($sourcePath, $destinationPath);

                //Checks if images was uploaded if not stops processing
                if ($upload == FALSE) {

                    $_SESSION['upload'] = "<div class='error'Image failed to be uploaded</div>";
                    header('location:' . HOMEURL . 'admin/addCategory.php');

                    die();

                }


            } else {

                $imageName = "";
            }

            //SQL query to insert category into Database
            $sql = "INSERT INTO category SET title='$title', imageName='$imageName', featured='$featured', active='$active'";

            //Execute the query and saves in the database
            $res = mysqli_query($conn, $sql);

            //Checks if the query was exectued or not and if data was entered into the database
            if ($res == true) {
                //Query executed and category was added
                $_SESSION['add'] = "<div class='allgoodsec'>Category added successfully</div>";
                //Redirect to Manage Category Page
                header('location:' . HOMEURL . 'admin/manageCategory.php');

            } else {
                //Failed to add category
                $_SESSION['add'] = "<div class='error'>Failed to add category</div>";
                //Redirect to Manage Category Page
                header('location:' . HOMEURL . 'admin/addCategory.php');


            }
        }
        ?>

    </div>
</div>

<?php include ('partials/footer.php'); ?>
<script src="script.js"></script>