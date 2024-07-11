<?php
    // constants.php for HOMEURL
    include('../config/constants.php');
    //Destroys session 
    session_destroy();

    // Redirect to login 
    header('location:'.HOMEURL.'admin/login.php');
?>