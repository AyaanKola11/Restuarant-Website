<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update category</h1>

        <br>
        <br>

        <?php
        //Checks if the Id of the category is set or not
        if (isset($_GET['categoryId'])) {

            //Gets the Id and all other details
            //echo "Getting the Data";
            $categoryId = $_GET['categoryId'];

            //Sql to get other info
            $sql = "SELECT * FROM category WHERE categoryId = $categoryId";

            //Query execution 
            $res = mysqli_query($conn, $sql);

            //Counts to check if the Id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                //Gets all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $currentImage = $row['imageName'];
                $featured = $row['featured'];
                $active = $row['active'];




            } else {

                //redirects to manage category with a session message
                $_SESSION['no-catg-found'] = "<div class='error'>Category was not found</div>";
                header('location:' . HOMEURL . 'admin/manageCategory.php');
            }

        } else {
            //Redirect page
            header('location:' . HOMEURL . 'admin/manageCategory.php');

        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-full">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                        if ($currentImage != "") {
                            //Display current image
                            ?>
                            <img src="<?php echo HOMEURL; ?>images/categories/<?php echo $currentImage; ?>" width="85px">

                            <?php
                        } else {
                            //Display message
                            echo "<div class='error'>Image not added</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>

                        <input <?php if ($featured == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="Yes">
                        Yes

                        <input <?php if ($featured == "No") {
                            echo "checked";
                        } ?> type="radio" name="featured" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>

                        <input <?php if ($active == "Yes") {
                            echo "checked";
                        } ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if ($active == "No") {
                            echo "checked";
                        } ?> type="radio" name="active" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="currentImage" value="<?php echo $currentImage; ?>">
                        <input type="hidden" name="categoryId" value="<?php echo $categoryId; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-primary">

                    </td>
                </tr>

            </table>
        </form>

        <?php

        if (isset($_POST['submit'])) {
            //echo "Clicked";
            //Get all the values from the form
            $categoryId = $_POST['categoryId'];
            $title = $_POST['title'];
            $currentImage = $_POST['currentImage'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2. Update the new image if selected
            if (isset($_FILES['image']['name'])) {
                $imageName = $_FILES['image']['name'];

                //checks if the image exists
                if ($imageName != "") {

                    //uploads new image 
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
                        header('location:'.HOMEURL.'admin/manageCategory.php');

                        die();

                    }

                    //Removes currentImage
                    if ($currentImage!="") {

                        $removePath = "../images/categories/".$currentImage;

                        $remove = unlink($removePath);

                        //Checks if the image was removed or not
                        if ($remove == FALSE) {

                            $_SESSION['removeFailed'] = "<div class='error'Current image failed to be removed</div>";
                            header('location:' . HOMEURL . 'admin/manageCategory.php');
                            die();
                        }
                    }


                } else {

                    $imageName = $currentImage;
                }


            } else {
                $imageName = $currentImage;
            }

            //3. Updates database
            $sql2 = "UPDATE category SET
                title = '$title',
                imageName = '$imageName',
                featured = '$featured',
                active = '$active'
                WHERE categoryId = $categoryId

            ";

            //Executes query 
            $res2 = mysqli_query($conn, $sql2);

            //4. Redirects to manage category page with message
            //Check if executed successfully
            if ($res2 == TRUE) {
                //Category updated
                $_SESSION['update'] = "<div class='allgood'>Category was updated successfully</div>";
                header('location:' . HOMEURL . 'admin/manageCategory.php');
            } else {

                //failed to update the category
                $_SESSION['update'] = "<div class='error'>Failed to update the category</div>";
                header('location:' . HOMEURL . 'admin/manageCategory.php');
            }

        }

        ?>

    </div>
</div>


<?php include ('partials/footer.php'); ?>