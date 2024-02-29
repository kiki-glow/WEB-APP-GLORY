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
        <div class="MyResetPasswordForm">

            <h1>SUCCESS</h1>
            <div>
                <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
                ?>
            </div>

            <div>
                <p>
                    Go back to Login page?
                    <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>login.php">
                        Login
                    </a>
                </p>
            </div>
        </div>
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