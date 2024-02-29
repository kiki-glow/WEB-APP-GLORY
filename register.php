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
    <style>
        /* CSS Styles */
        .FILE-INPUT {
            display: none;
        }
    </style>
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

        <div class="register">


            <!-- Register Form Starts HEre -->
            <form action="" method="POST" class="MyRegisterForm" enctype="multipart/form-data">

                <h1>Register</h1>

                <div>
                    <label class="w-full relative flex items-center h-full">
                        <input type="text" class="FILE-INPUT" placeholder="Choose Profile" readonly>
                        <label for="userProfile" class="btn2">Choose Image</label>
                    </label>
                    <input type="file" id="userProfile" name="userProfile" hidden accept=".jpeg, .png, .jpg">
                </div>

                <div>
                    <input required class="INPUT" type="text" name="full_name" placeholder="Enter Full Name...">
                </div>

                <div>
                    <input required class="INPUT" type="text" name="username" placeholder="Enter Username...">
                </div>

                <div>
                    <input required class="INPUT" type="text" name="email" placeholder="Enter Email...">
                </div>

                <div>
                    <input required class="INPUT" type="number" name="phone" placeholder="Enter Phone...">
                </div>

                <div>
                    <input required class="INPUT" type="password" name="password" placeholder="Enter Password...">
                </div>

                <div>
                    <input type="submit" name="submit" value="Register" class="btn">
                </div>

                <div>
                    <p>
                        Already have an account?
                        <a class="LOGIN_LINK_ITEM" href="<?php echo SITEURL_USER; ?>login.php">
                            Login
                        </a>
                    </p>
                </div>

            </form>
            <!-- Login Form Ends HEre -->


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

<?php

//Process the Value from Form and Save in Database

//Check whether the Submit button is clicked or not

if (isset($_POST['submit'])) {
    //Button Clicked

    //1. Get the data from Form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']); //password encryption with md5

    //2a. Upload images if selected
    //check whether Select Image is clicked or not and upload image only if selected
    if (isset($_FILES['userProfile']['name'])) {
        //get the details of the selected image
        $image_name = $_FILES['userProfile']['name'];

        //check whether the image is selected or not and upload image only if selected
        if ($image_name != "") {
            //image is selected
            //A.REname the image
            //get the extension of selected image
            $ext = end(explode('.', $image_name));

            //create new name for image
            $image_name = "User-Profile-" . rand(0000, 9999) . "." . $ext; //new image name may be "User-Profile-8462.jpg"

            //B.UPload the image
            //get the SRC path and Destination path

            //Source path is the current location of image to be uploaded
            $src = $_FILES['userProfile']['tmp_name'];

            //Destination path is the location uploaded image will be stored
            $dst = "images/userProfile/" . $image_name;

            //finally upload the image
            $upload = move_uploaded_file($src, $dst);

            //check whether image uploaded or not
            if ($upload == false) {
                //failed to upload the image
                //redirect to home page with error
                $_SESSION['upload'] = "<div class='ERROR'>Failed to Upload Image</div>";
                header('location:' . SITEURL_USER . 'register.php');
                ob_end_flush();
                //stop the process
                die();
            }
        } else {
            $image_name = "No-Profile.png"; //setting default value
        }
    }

    //3. SQL Query to Save the data into database
    $sql = "INSERT INTO user SET
                full_name = '$full_name',
                username = '$username',
                userProfile = '$image_name',
                email = '$email',
                phone = '$phone',
                password = '$password'
            ";

    //4. Executing query and inserting data into database
    $res = mysqli_query($conn, $sql);

    //5. Check whether the (query is executed) data is inserted or not and display approriate message
    if ($res == TRUE) {
        //Admin Added
        //create session message variable to display message
        $_SESSION['register'] = "<div class='SUCCESS'>Account Created Successfully</div>";
        //redirect to Manage Admin Page
        header('location:' . SITEURL_USER . 'login.php');
        ob_end_flush();
    } else {
        //failed to add Admin
        //create session message variable to display message
        $_SESSION['register'] = "<div class='ERROR'>Failed to Create Account</div>";
        //redirect to Manage Admin Page
        header('location:' . SITEURL_USER . 'login.php');
        ob_end_flush();
    }

}

?>