<?php include ('../config/constants.php'); ?>

<html>

<head>
    <title>Login - Sultan Food Order System</title>
    <link rel="stylesheet" href="../css/loginForm.css">
</head>

<body>
    <div class="login-page">
        <div class="login">
            <h1>Admin Login</h1>
            

            <?php
            if (isset($_SESSION['login'])) {
                //echo $_SESSION['login'];
                echo '<div id="session-message-lgin">' . $_SESSION['login'] . '</div>';
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message'])){
                //echo $_SESSION['no-login-message'];
                echo '<div id="noLoginMesg">' . $_SESSION['no-login-message'] . '</div>';
                unset($_SESSION['no-login-message']);
            }
            ?>

            <br>

            <form action="" method="POST" class="login-form">

                <input type="text" name="username" placeholder="Enter username">
                <input type="password" name="password" placeholder="Enter password">
                <br><br>
                <input type="submit" name="submit" value="Login" class="buttonlgn">

            </form>
        </div>
    </div>

</body>

</html>

<?php
//Checks if the submit button was pressed or not
if (isset($_POST['submit'])) 
{
    //Gets Login form data
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //checks if username and password exist or not
    $sql = "SELECT * FROM tbladmin WHERE username='$username' AND password='$password'";

    //Execution of the query
    $res = mysqli_query($conn, $sql);

    // Counts rows to check if the user exists or not
    $count = mysqli_num_rows($res);

    if($count == 1) 
    {

        //User is available and show login success message
        $_SESSION['login'] = "<div class='allgood'>Login Successful</div>";
        $_SESSION['user'] = $username; //Checks if the user is logged in or not.

        //Redirect to home page
        header('location:'.HOMEURL.'admin/');
 } 
    else 
    {
        // User not found
        $_SESSION['login'] = "<div class='error'>Username or Password incorrect</div>";
        //Redirect tp home page
        header('location:'.HOMEURL.'admin/login.php');
    }
}
?>
<script src="script.js"></script>