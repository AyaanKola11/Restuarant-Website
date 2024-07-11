<?php

include('../config/constants.php');

//echo "Delete Food Page";

if (isset($_GET['mealId']) && isset($_GET['imageName'])) { //Either use '&&' or 'AND'


    //Process to delete
    //echo "Process to Delete";

    //Gets the MealId and name
    $mealId = $_GET['mealId'];
    $imageName = $_GET['imageName'];

    // Removes the Image if available 
    //Checks if the image exists
    if($imageName != "")
    {
        $path = "../images/Meal/".$imageName;

        //removes the image
        $remove = unlink($path);

        //Check if the image was removed or not
        if($remove == FALSE)
        {
            //Failed
            $_SESSION['upload'] = "<div class='error'>Failed to remove image</div>";
            
            //Redirect to manage food
            header('location:'.HOMEURL.'admin/manageFood.php');

            //stops the process
            die();
        }
    }

    // Deletes Food from database
    $sql = "DELETE FROM meal WHERE mealId = $mealId";

    //Executes the query
    $res = mysqli_query($conn, $sql);

    //Checks if the query was executed and sets the session message
    //Redirect with a session message
    if($res == TRUE) {

        $_SESSION['delete'] = "<div class='allgood'>Food was deleted successfully</div>";
        header('location:'.HOMEURL.'admin/manageFood.php');
        exit();

    }else {

        $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
        header('location:'.HOMEURL.'admin/manageFood.php');
        exit();

    }

    



} else {

    //redirect to manage food page
    $_SESSION['unauthorized'] = "<div class='error'>Unauthorized Access</div>";
    header('location:' . HOMEURL . 'admin/manageFood.php');
    exit();
}

?>