<?php 

    include('../config/constants.php'); 
    include('loginCheck.php');
?>



<html>

<head>
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <!-- The Menu Section Starts here -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="manageAdmin.php">Admin</a>
                </li>
                <li>
                    <a href="manageCategory.php">Category</a>
                </li>
                <li>
                    <a href="manageFood.php">Food</a>
                </li>
                <li>
                    <a href="manageOrder.php">Order</a>
                </li>
                <li>
                    <a href="logOut.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- The Menu Section Ends here -->