<?php

include 'config/constants.php';
include 'login_check.php';

?>

<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        GlowTechs
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

		<!--===========================================================NAV_BAR_SECTION SECTION START====================================================-->
		<nav>
            <div class="logo">
				<a href="index.php">
					<img src="images/glow.png" alt="GlowTechs Logo">
					<span>Glow</span>Techs
				</a>
			</div>
            <menu class="NAV_TOGGLER_MENU /// NAV_TOGGLER_CLOSE">

                <ul>
                    <li class="CLOSE_BTN_BOX hidden">
                        <p class="CLOSE_BTN">X</p>
                    </li>

                    <li>
                        <a class="NAV_LI" href="<?php echo SITEURL_USER; ?>">Home</a>
                    </li>
                    <li>
                        <a class="NAV_LI" href="#">About</a>
                    </li>
                    <li>
                        <a class="NAV_LI" href="https://my-portfolio-kiki-glows-projects.vercel.app/">Services</a>
                    </li>
                    <li>
                        <a class="NAV_LI" href="#Footer">Contact</a>
                    </li>
                    <li class="dark-mode">
                        <div class="DAY_NIGHT">
                            <i class="DL_ICON fa-sharp fa-regular fa-moon"></i>
                        </div>
                    </li>
                    <li>
                        <?php
                            // Get user ID from the login_check.php
                            $user_id = $_SESSION['user_id'];
                                                                                
                            // Query to get the user's profile from the user table
                            $sql = "SELECT * FROM user WHERE id = $user_id ORDER BY id DESC";
                            // Execute the query
                            $res = mysqli_query($conn, $sql);

                            // Check whether the query is executed or not
                            if ($res == TRUE) {
                                // Count rows to check whether we have data in the database or not
                                $count = mysqli_num_rows($res); // Function to get all rows in the database

                                $sn = 1; // Create a variable and assign the value

                                // Check the number of rows
                                if ($count > 0) {
                                    // We have data in the database
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                        // Using while loop to get all the data from the database
                                        // The while loop will run as long as there's data in the database

                                        // Get individual data
                                        $id = $rows['id'];
                                        $username = $rows['username'];
                                        $userProfile = $rows['userProfile'];
                                        
                                        // Display the values in our card
                                        ?>

                                        <div class="user-icon" onclick="toggleDropdown()">
                                            <?php
                                                // Check whether the image is available or not
                                                if ($userProfile != "") {
                                                    // Display image
                                                    ?>
                                                    <img src="images/userProfile/<?php echo $userProfile ?>" alt="User Image">
                                                    <?php
                                                } else {
                                                    // Display message
                                                    echo "<div class='ERROR'>Image Not Added</div>";
                                                }
                                            ?>
                                            <div class="dropdown" id="dropdownMenu">
                                                <a class="NAV_LI dropdown-item" href="#">View Profile</a>
                                                <a class="NAV_LI dropdown-item" href="<?php echo SITEURL_USER; ?>logout.php">Logout</a>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="ERROR">Account error.</div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        ?>
                    </li>
                </ul>
            </menu>
            <div class="NAV_TOGGLER">
				<span>
                    <i class="NAV_TOGGLER_ICON fa-solid fa-bars"></i>
                </span>
			</div>
        </nav>
	<!--===========================================================NAV_BAR_SECTION SECTION END====================================================-->
