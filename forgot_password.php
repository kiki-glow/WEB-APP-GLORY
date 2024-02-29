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
            <h1>Forgot Password</h1>
            <div>
                <input required class="INPUT" type="email" name="email" placeholder="Enter your email">
            </div>
            <div>
                <input type="submit" name="submit" value="Send Link" class="btn">
            </div>

            <div>
                <p>
                    Go back to Login page?
                    <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>login.php">
                        Login
                    </a>
                </p>
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
// Include PHPMailer autoloader
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    $email = $_POST['email'];

    // Generate a random password reset token
    $token = bin2hex(random_bytes(32));

    // Store the token in the database along with the user's email
    $sql = "UPDATE user SET reset_token='$token' WHERE email='$email'";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        // Send reset password email
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_USERNAME;
            $mail->Password = EMAIL_PASSWORD;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Recipient
            $mail->setFrom(EMAIL_USERNAME, 'Glowtechs');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Password';
            $mail->Body = '
    <div style="font-family: Arial, sans-serif; text-align: center;">
        <h2 style="color: #333;">Glowtechs</h2>
        <img src="http://localhost/glowtechs/images/logo.png" alt="Glowtechs Logo" width="150" height="150" style="border-radius: 50%; object-fit: cover;">
        <hr style="border-top: 1px solid #ccc;">
        <p style="color: #333;">Click the reset password button below to reset your password:</p>
        <p><a href="' . SITEURL_USER . 'reset_password.php?token=' . $token . '" style="color: #fff; background-color: #8fc008; padding: 10px 20px; border-radius: 7px; text-decoration: none; display: inline-block;">Reset Password</a></p>
    </div>
';


            $mail->send();
            $_SESSION['message'] = "<div>Reset password link sent to your email</div>";
            header('location:' . SITEURL_USER . 'success.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['messageB'] = "<div>Failed to send reset password link</div>";
            header('location:' . SITEURL_USER . 'error.php');
            exit();
        }
    } else {
        $_SESSION['messageC'] = "<div>Email not found</div>";
        header('location:' . SITEURL_USER . 'error.php');
        exit();
    }
}
?>