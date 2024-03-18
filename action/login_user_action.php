<?php 
session_start();
include "../settings/connection.php";

if(isset($_POST['submit'])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM Users WHERE email = '$username'";

    if ($result = mysqli_query($con, $query)) {
        if(mysqli_num_rows($result) > 0) {
            $q_result = mysqli_fetch_assoc($result);
            
            if(password_verify($password, $q_result["Passwd"])) {
                $_SESSION["user_id"] = $q_result["UserID"];

                if(isset($_SESSION['user_id'])){
                    $_SESSION['totalTransactionAmount'] = 0;
                    $_SESSION['totalbudget'] = 0;
                    header("Location: ../view/main.php");
                    exit(); 
                }
            } else {
                echo "Username or Password is incorrect!";
            }
        } else {
            echo "Username or Password is incorrect!";
        }

        mysqli_free_result($result); // Free the result set
    } else {
        die("Error: " . mysqli_error($con));
    }
}
?>
