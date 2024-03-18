<?php 
session_start();
function login(){
    if(!isset($_SESSION['user_id'])) // If session is not set then redirect to Login Page
    {
        header('Location:../login/login_page.php' ); 
        die();
}
}
login();



