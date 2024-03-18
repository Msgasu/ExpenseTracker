<?php
// Include database connection
include "../settings/connection.php";

// Check if all required fields are provided
if (isset($_POST['transaction_id'], $_POST['amount'], $_POST['date'], $_POST['description'])) {
    // Sanitize and validate input data
    $transactionID = mysqli_real_escape_string($con, $_POST['transaction_id']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // Perform update operation
    $sql = "UPDATE Transaction SET Amount = '$amount', TransactionDate = '$date', Description = '$description' WHERE TransactionID = '$transactionID'";
    if (mysqli_query($con, $sql)) {
        // Respond with success message
        echo "Transaction updated successfully!";
    } else {
        // If update fails, respond with an error message
        echo "Error: " . mysqli_error($con);
    }
} else {
    // If any required field is missing, respond with an error message
    echo "All fields are required!";
}

// Close database connection
mysqli_close($con);
?>
