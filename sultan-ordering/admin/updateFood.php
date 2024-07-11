<?php 
ob_start(); // Start output buffering
include ('partials/menu.php'); 

// Check if the id is set or not
if (isset($_GET['mealId'])) {
    // Get details
    $mealId = $_GET['mealId'];

    // SQL query to select the meal
    $sql2 = "SELECT * FROM meal WHERE mealId=$mealId";

    // Execute query
    $res2 = mysqli_query($conn, $sql2);

    // Get the value
    if ($res2) {
        $row2 = mysqli_fetch_assoc($res2);

        // Get the individual values of the selected meal
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $currentImage = $row2['imageName'];
        $currentCategory = $row2['categoryId'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    } else {
        header('location:' . HOMEURL . 'admin/manageFood.php');
        exit;
    }
} else {
    // Redirect to manage food
    header('location:' . HOMEURL . 'admin/manageFood.php');
    exit;
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Meal</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-full">

                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                        if ($currentImage == "") {
                            echo "<div class='error'>Image is not available</div>";
                        } else {
                            ?>
                            <img src="<?php echo HOMEURL; ?>images/Meal/<?php echo $currentImage; ?>" width="85px">
                            <?php
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select new image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $categoryTitle = $row['title'];
                                    $categoryId = $row['categoryId'];
                                    ?>
                                    <option <?php if ($currentCategory == $categoryId) echo "selected"; ?> value="<?php echo $categoryId; ?>"><?php echo $categoryTitle; ?></option>
                                    <?php
                                }
                            } else {
                                echo "<option value='0'>Category is not available</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if ($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if ($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if ($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if ($active == "No") echo "checked"; ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="mealId" value="<?php echo $mealId; ?>">
                        <input type="hidden" name="currentImage" value="<?php echo $currentImage; ?>">
                        <input type="submit" name="submit" value="Update meal" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all input from form
            $mealId = $_POST['mealId'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $currentImage = $_POST['currentImage'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // Check if new image is selected
            if (isset($_FILES['image']['name'])) {
                // Upload button clicked
                $imageName = $_FILES['image']['name'];

                if ($imageName != "") {
                    // Image is available
                    $temp = explode('.', $imageName);
                    $ext = end($temp);

                    $imageName = "Meal-Name-" . rand(0000, 9999) . '.' . $ext;

                    $srcPath = $_FILES['image']['tmp_name'];
                    $destPath = "../images/Meal/" . $imageName; // Destination Path

                    // Upload image
                    $upload = move_uploaded_file($srcPath, $destPath);

                    // Check if the image was uploaded successfully
                    if ($upload == FALSE) {
                        // Failed to upload
                        $_SESSION['upload'] = "<div class='error'>New image failed to upload</div>";
                        header('location:' . HOMEURL . 'admin/manageFood.php');
                        exit;
                    }

                    // Remove current Image if available
                    if ($currentImage != "") {
                        // Current image is available
                        $removePath = "../images/Meal/" . $currentImage;
                        $remove = unlink($removePath);

                        // Check if the image was removed successfully
                        if ($remove == FALSE) {
                            $_SESSION['remove-Failed'] = "<div class='error'>Failed to remove current image</div>";
                            header('location:' . HOMEURL . 'admin/manageFood.php');
                            exit;
                        }
                    }
                } else {
                    $imageName = $currentImage;
                }
            } else {
                $imageName = $currentImage;
            }

            $sql3 = "UPDATE meal SET
                title = '$title',
                description = '$description',
                price = '$price',
                imageName = '$imageName',
                categoryId = '$category',
                featured = '$featured',
                active = '$active'
                WHERE mealId=$mealId";

            // Execute sql query
            $res3 = mysqli_query($conn, $sql3);

            // Check if the query was executed successfully
            if ($res3 == TRUE) {
                $_SESSION['updateMeal'] = "<div class='allgood'>Meal updated successfully</div>";
                header('location:' . HOMEURL . 'admin/manageFood.php');
                
            } else {
                $_SESSION['updateMeal'] = "<div class='error'>Failed to update Meal</div>";
                header('location:' . HOMEURL . 'admin/manageFood.php');
                
            }
        }
        ?>
    </div>
</div>

<?php 
include ('partials/footer.php'); 
ob_end_flush(); // End output buffering and flush output
?>