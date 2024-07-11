<?php include ('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
        if (isset($_GET['adminId'])) {
            $adminId = $_GET['adminId'];
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-b">
                <tr>
                    <td>Current password: </td>
                    <td>
                        <input type="password" name="currentPassword" placeholder="Current password">
                    </td>
                </tr>

                <tr>
                    <td>New password: </td>
                    <td>
                        <input type="password" name="newPassword" placeholder="New password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm password: </td>
                    <td>
                        <input type="password" name="confirmPassword" placeholder="Confirm password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="adminId" value="<?php echo $adminId; ?>">
                        <input type="submit" name="submit" class="btn-sec" value="Change password">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
//Checks if the submit button is clicked or not 
if (isset($_POST['submit'])) {
    //echo clicked

    //1. Get the data from form
    $adminId = $_POST['adminId'];
    $currentPassword = md5($_POST['currentPassword']);
    $newPassword = md5($_POST['newPassword']);
    $confirmPassword = md5($_POST['confirmPassword']);

    //2. Check if the user with current ID and current password is there or not 
    $sql = "SELECT * FROM tbladmin WHERE adminId = $adminId AND password='$currentPassword'";

    //Execute query
    $res = mysqli_query($conn, $sql);

    if ($res == TRUE) {
        //Checks if data is available
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            //User exists
            //echo "User found";
            //Checks if the new password and confirm password section match
            if ($newPassword == $confirmPassword) {
                //Update the password
                $sql2 = "UPDATE tbladmin SET password = '$newPassword' WHERE adminId = $adminId";

                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //Check if the query succeeded or not
                if ($res2 == TRUE) {
                    //Show success message
                    //Redirect to the Manage admin page with a success message
                    $_SESSION['changePswd'] = "<div class='allgood'>Password has changed successfully</div>";

                    //Redirects user
                    header('location:' . HOMEURL . 'admin/manageAdmin.php');
                } else {
                    //Show error message
                    //Redirect to the Manage admin page with an error message
                    $_SESSION['changePswd'] = "<div class='error'>Failed to change password</div>";

                    //Redirects user
                    header('location:' . HOMEURL . 'admin/manageAdmin.php');
                }
            } else {
                //Redirect to the Manage admin page with an error message
                $_SESSION['pswdNotMatch'] = "<div class='error'>Passwords do not match</div>";

                //Redirects the user
                header('location:' . HOMEURL . 'admin/manageAdmin.php');

            }
        } else {
            //User does not exist set message and redirect 
            $_SESSION['userNotFound'] = "<div class='error'>User not found</div>";

            //Redirects the user
            header('location:' . HOMEURL . 'admin/manageAdmin.php');
        }
    }
    //3. Check if new passwords match with confirm password

    //4. Change password if all above is true
}
?>

<?php include ('partials/footer.php') ?>