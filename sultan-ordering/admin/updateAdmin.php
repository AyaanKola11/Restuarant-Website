<?php include ('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br>
        <br>

        <?php
        //1.Gets the ID of the selected Admin
        $adminId = $_GET['adminId'];


        //2. Creates SQL Query to get the Details
        $sql = "SELECT * FROM tbladmin WHERE adminId = $adminId";

        //Executes the SQL query
        $res = mysqli_query($conn, $sql);

        // Checks if the query is executed or not
        if ($res == TRUE) {
            // Checks if the data is available or not
            $count = mysqli_num_rows($res);

            // Checks if there is any admin data
            if ($count == 1) {
                //Get Details
                //echo "Admin available";
                $row = mysqli_fetch_assoc($res);

                $fullName = $row['fullName'];
                $username = $row['username'];
            } else {
                // Redirect to Manage Admin
                header('location:' . HOMEURL . 'admin/manageAdmin.php');
            }
        }

        ?>

        <form action="" method="POST">

            <table class="tbl-b">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="fullName" value="<?php echo $fullName; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="adminId" value="<?php echo $adminId; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-sec">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php
// Check if the submit button is clicked
if (isset($_POST['submit'])) {
    //echo "Button clicked";
    //Gets all values from the form to update
    $adminId = $_POST['adminId'];
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];

    //SQL query that updates admin
    $sql = "UPDATE tbladmin SET
          fullName = '$fullName',
          username = '$username' 
          WHERE adminId = '$adminId'
         ";

    //Execute SQL query
    $res = mysqli_query($conn, $sql);

    //Checks if the query succeeded
    if ($res == TRUE) {
        //Query executed
        $_SESSION['update'] = "<div class='allgood'>Admin updated succesfully</div>";
        //Redirect to Manage Amin
        header('location:' . HOMEURL . 'admin/manageAdmin.php');

    } else {
        //Query executed
        $_SESSION['update'] = "<div class='allgood'>Failed to updated admin</div>";
        //Redirect to Manage Amin
        header('location:' . HOMEURL . 'admin/manageAdmin.php');
    }

}
?>

<?php include ('partials/footer.php'); ?>

<script src="script.js"></script>