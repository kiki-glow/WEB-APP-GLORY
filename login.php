<?php include 'config/constants.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Glowtechs
    </title>
    <link href="images/logo.png" type="image/x-icon" rel="icon">
    <link href="css/style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="DARK_MODE">


<div id="pre_loader" class="pre_loader">
    <div class="loader">
        <div class="ring"></div>
        <div class="ring"></div>
        <div class="ring"></div>
        <span class="loading">GlowTechs</span>
    </div>
</div>

<div id="SECTIONS" class="SECTIONS hidden">

    <div class="login">
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="MyLoginForm">
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if (isset($_SESSION['no-login-message'])) {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }

            if (isset($_SESSION['message2'])) {
                echo $_SESSION['message2'];
                unset($_SESSION['message2']);
            }

            if (isset($_SESSION['register'])) {
                echo $_SESSION['register'];
                unset($_SESSION['register']);
            }
            ?>

            <h1>Login</h1>

            <div>
                <input required class="INPUT" type="text" name="username" placeholder="Enter Username...">
            </div>

            <div>
                <input required class="INPUT" type="password" name="password" placeholder="Enter Password...">
            </div>

            <div>
                <input type="submit" name="submit" value="Login" class="btn">
            </div>

            <div>
                <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>forgot_password.php">
                    Forgot password?
                </a>
            </div>

            <div>
                <p>
                    Don't have an account?
                    <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>register.php">
                        Register
                    </a>
                </p>
            </div>
        </form>
        <!-- Login Form Ends Here -->
    </div>

</div>

    <!--===========================================================JS FILES====================================================-->

    <script src="https://kit.fontawesome.com/2820328d2c.js" crossorigin="anonymous"></script>

    <script type="module"
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule
            src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!--=========================MAIN JS=========================-->

    <script src="js/script.js"></script>

    <!--=========================MAIN JS=========================-->

</body>
</html>

<?php
// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process data from the login form
    // 1. Get the data from the login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. SQL to check whether the user with that username and password exists
    $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available and login successful
        $row = mysqli_fetch_assoc($res);
        $user_id = $row['id'];
        $_SESSION['login'] = "<div class='SUCCESSBOX2'><div class='SUCCESS2'>Welcome back $username.</div></div>";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and logout unsets it
        $_SESSION['user_id'] = $user_id; // Store the user_id in the session

        // Redirect to Manage Admin Page
        header('location:'.SITEURL_USER.'index.php');
        ob_end_flush();
    } else {
        // Failed to login
        $_SESSION['login'] = "<div class='ERROR'>Username and Password<br>did not match</div>";
        // Redirect back to login page
        header('location:'.SITEURL_USER.'login.php');
        ob_end_flush();
    }
}
?>
