<?php
include "../settings/connection.php";

if (isset($_POST['submitBtn'])) {
    $first_name = $_POST["firstname"];
    $last_name = $_POST["lastname"];
    $dob = $_POST["dob"];
    $email = $_POST["email"];
    $phone = $_POST["phonenumber"];
    $pass_1 = $_POST["password"];
    $pass_2 = $_POST["confirmpassword"];

    // Hash the password
    $hash = password_hash($pass_2, PASSWORD_DEFAULT);

    // Create a prepared statement
    $query = "INSERT INTO users (email, first_name, last_name, DOB, PhoneNumber, Passwd)
              VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ssssss", $email, $first_name, $last_name, $dob, $phone, $hash);

    // Execute the statement
    if (!mysqli_stmt_execute($stmt)) {
        die("Error: " . mysqli_error($con));
    } else {
        header("Location: ../login/login_page.php");
        exit(); // Ensure script stops execution after redirection
    }

    // Close the statement
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>
