<?php

    //constants.php file here
    include('../config/constants.php');

// 1. get the ID of admin to be deleted
 $adminId = $_GET['adminId'];

// 2. Create an SQL query to delete the admin
$sql = "DELETE FROM tbladmin WHERE adminId = $adminId";

//Execute the Query
$res = mysqli_query($conn, $sql);

// Checks if the query executed or not 
if($res == true)
{
    // Query is executed and admin is deleted
    //echo "Admin deleted";
    //Creates session variable to show message
    $_SESSION['delete'] = "<div class='allgood'>Admin has been deleted successfully</div>";
    //Redirect to Manage admin page
    header('location:'.HOMEURL.'admin/manageAdmin.php');

} else {

    // Has failed to delete admin
    //Creates session variable to show message
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";
    //Redirect to Manage admin page
    header('location:'.HOMEURL.'admin/manageAdmin.php');

}

// 3. Redirect to Manage Admin Page with message (success/error)

?>