<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
            if(isset($_POST['add']))  //Checks if the session is set or not
            {
                // echo$_SESSION['add']; //Displays session message if set
                echo '<div id="session-message">' . $_SESSION['add'] . '</div>';
                unset($_POST['add']); //Remove session message
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-b">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="fullName" placeholder="Enter your name"></td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter a username"></td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter a password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php include ('partials/footer.php'); ?>

<script src="script.js"></script>

<?php
// Prcoess the form and saves it in the database
// Checks wheter the button is clicked or not 

if (isset($_POST['submit'])) {
    // Button Clicked
    // echo "Button Clicked";
    //Get the data from form
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption

    $sql = "INSERT INTO tbladmin SET
            fullName='$fullName',
            username='$username',
            password='$password'
       
       ";

    //Executes query and saves into database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Check whether the Query is inserted or not and display message
    if ($res == TRUE) {
        //Data Inserted
        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='allgoodsec'>Admin has been added successfully</div>";
        //Redirect Page to manage admin
        header("location:" . HOMEURL . 'admin/manageAdmin.php');

    } else {
        //Failed to Insert Data
        //Create a Session Variable to display Message
        $_SESSION['add'] = "<div class='errorsec'>Failed to add admin</div>";
        //Redirect Page to add admin
        header("location:" . HOMEURL . 'admin/addAdmin.php');
    }

}

?>