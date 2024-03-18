<?php
include_once "../settings/core.php";  



// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or any other page
header("Location: login_page.php");
exit;
?>
