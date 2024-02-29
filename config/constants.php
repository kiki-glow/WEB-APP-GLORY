<?php
ob_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
//start Session
session_start();


//create constants to store non repeating values
define('SITEURL_USER', 'http://localhost/glowtechs/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'Glory');//replace 'MyDatabaseUsername' with your actual Database Username
define('DB_PASSWORD', '@Techy_Nicc@r17');//replace 'MyDatabasePassword' with your actual Database Password
define('DB_NAME', 'glowtechs');//replace 'MyDatabaseName' with your actual Database Name
define('EMAIL_USERNAME', 'glorykinya706@gmail.com');//replace 'MyEmail/WebsiteEmail' with your actual Email Address or the Email Address of the website
define('EMAIL_PASSWORD', 'yvhf txht pvdp tbcg');//go to your gmail account and search for App Passwords, enter the name of your website in the dialog box provided and click generate app password, copy the password provided and replace 'MyAppPassword' with the password you have copied. This is for authentication with SMTP server to send email

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>
