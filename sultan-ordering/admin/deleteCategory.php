<?php

include ('../config/constants.php');

    //echo "Delete Page";
    //Checks if the id and image name was set 
    if(isset($_GET['categoryId']) && isset($_GET['imageName']))
    {
        //Gets value and deletes it
        echo "Gets Value and Delete";
        $categoryId = $_GET['categoryId'];
        $imageName = $_GET['imageName'];

        //Removes image if available
        if($imageName != "")
        {
            //Image available and removes
            $path = "../images/categories/".$imageName;
            //Remove image
            $remove = unlink($path);

            //removes image then shows an error msg to stop the process
            if($remove == FALSE){
                //Sets the session message
                $_SESSION['remove'] = "<div class='error'>Failed to remove the catgory image</div>";
                //Redirect Page
                header('location:'.HOMEURL.'admin/manageCategory.php');
                //Stops process
                die();
            }
        }

        //SQL Query deletes data from the database
        $sql = "DELETE FROM category WHERE categoryId=$categoryId";

        $res = mysqli_query($conn, $sql);

        //Checks if data is available
        if($res == TRUE) {

            //Sets success message and redirects page
            $_SESSION['delete'] = "<div class='allgood'>Category was deleted successfully</div>";
            header('location:'.HOMEURL.'admin/manageCategory.php');

        }else {

            //Sets fail message and redirects page
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            header('location:'.HOMEURL.'admin/manageCategory.php');
        }

     
    }else {
        //Redirect page 
        header('location:'.HOMEURL.'admin/manageCategory.php');
    }

?>