<?php
//Authorization - Access Control
// Checks if the user is logged in or not
if(!isset($_SESSION['user'])){  //if user session is not set
    //User is not logged in
    //Redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error'>Login to access admin panel</div>";
    //Redirects to login page
    header('location:'.HOMEURL.'admin/login.php');
}


?>