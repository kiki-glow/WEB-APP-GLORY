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

<body>

    <div class="resetPassword">
        <form action="" method="POST" class="MyResetPasswordForm">
            <h1>Reset Password</h1>
            <div>
                <input required class="INPUT" type="password" name="password" placeholder="Enter New Password...">
            </div>
            <div>
                <input type="submit" name="submit" value="Reset Password" class="btn">
            </div>
        </form>
    </div>



    <!--===========================================================JS FILES====================================================-->

    <script src="https://kit.fontawesome.com/2820328d2c.js" crossorigin="anonymous"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!--=========================MAIN JS=========================-->

    <script src="js/script.js"></script>

    <!--=========================MAIN JS=========================-->




</body>

</html>

<?php
//Check whether the submit button is clicked or not
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Validate the reset token
    $sql = "SELECT * FROM user WHERE reset_token='$token'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        if (isset($_POST['submit'])) {
            $password = md5($_POST['password']);
            $row = mysqli_fetch_assoc($res);
            $email = $row['email'];

            // Update the user's password
            $sql = "UPDATE user SET password='$password', reset_token=NULL WHERE email='$email'";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $_SESSION['message2'] = "<div class='SUCCESS'>Password reset successfully</div>";
                header('location:' . SITEURL_USER . 'login.php');
                exit();
            } else {
                $_SESSION['message2B'] = "<div>Failed to reset password</div>";
                header('location:' . SITEURL_USER . 'error.php');
                exit();
            }
        }
    } else {
        $_SESSION['message2C'] = "<div>Invalid reset token</div>";
        header('location:' . SITEURL_USER . 'error.php');
        exit();
    }
} else {
    $_SESSION['message2D'] = "<div>Token not provided</div>";
    header('location:' . SITEURL_USER . 'error.php');
    exit();
}
?>
