<?php include ('partials/menu.php'); ?>

<!-- Main Content Section Starts here -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br />


        <?php
        if (isset($_SESSION['add'])) {
            // echo $_SESSION['add']; //Displays session message
            echo '<div id="session-message">' . $_SESSION['add'] . '</div>';
            unset($_SESSION['add']); //This will remove the session message
        }

        if(isset($_SESSION['delete'])){
            // echo $_SESSION['delete'];
            echo '<div id="session-message-delete">' . $_SESSION['delete'] . '</div>';
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['update']))
        {
            //echo $_SESSION['update'];
            echo '<div id="session-message-update">' . $_SESSION['update'] . '</div>';
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['userNotFound'])){
            //echo $_SESSION['userNotFound'];
            echo '<div id="session-message-user-not-found">' . $_SESSION['userNotFound'] . '</div>';
            unset ($_SESSION['userNotFound']);
        }

        
        if(isset($_SESSION['pswdNotMatch'])){
            //echo $_SESSION['pswdNotMatch'];
            echo '<div id="session-message-pswdNotMatch">' . $_SESSION['pswdNotMatch'] . '</div>';
            unset ($_SESSION['pswdNotMatch']);
        }

        if(isset($_SESSION['changePswd'])){
            //echo $_SESSION['changePswd'];
            echo '<div id="session-message-changePswd">' . $_SESSION['changePswd'] . '</div>';
            unset ($_SESSION['changePswd']);
        }

       
        ?>

        <br />
        <br />
        <br />

        <!-- Button for adding the Admin -->
        <a href="addAdmin.php" class="btn-sec">Add Admin</a>

        <br />
        <br />

        <table class="tbl-full">
            <tr>
                <th>Admin Id</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <?php

            $sql = "SELECT * FROM tbladmin";
            //Execute the query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is exectuted or not 
            if ($res == TRUE) {
                // Count Rows to check if we have data in the database or not
                $count = mysqli_num_rows($res); //Gets all rows in the databse

                $cn = 1; // Variable is assigned
            
                //Checks num of rows
                if ($count > 0) {
                    //We got data in the database
                    while ($rows = mysqli_fetch_assoc($res)) {
                        //The while loop is used to get all data from the database
                        //And it will run as long as there's data in the database
            
                        //Gets data indivually
                        $adminId = $rows["adminId"];
                        $fullName = $rows["fullName"];
                        $username = $rows["username"];

                        //Displays values in the table
                        ?>
                        <tr>
                            <td><?php echo $cn++;?></td>
                            <td><?php echo $fullName;?></td>
                            <td><?php echo $username;?></td>
                            <td>
                                <a href="<?php echo HOMEURL;?>admin/changePassword.php?adminId=<?php echo $adminId; ?>" class="btn-sec">Change password</a>
                                <a href="<?php echo HOMEURL;?>admin/updateAdmin.php?adminId=<?php echo $adminId; ?>" class="btn-sec">Update admin</a>
                                <a href="<?php echo HOMEURL;?>admin/deleteAdmin.php?adminId=<?php echo $adminId; ?>" class="btn-red">Delete admin</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    //No data in the database
                }
            }

            ?>

        </table>

    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</div>
<!-- Main Content Section Ends here -->

<?php include ('partials/footer.php'); ?>

<script src="script.js"></script>