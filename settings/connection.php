<?php
// Check if constants are not defined before defining them
if (!defined('HOST')) {
    define("HOST", "localhost");
}
if (!defined('DB_NAME')) {
    define("DB_NAME", "ms_2025");
}
if (!defined('USERNAME')) {
    define("USERNAME", "root");
}
if (!defined('PASSWORD')) {
    define("PASSWORD", "");
}

$con = new mysqli(HOST, USERNAME, PASSWORD, DB_NAME);
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>
