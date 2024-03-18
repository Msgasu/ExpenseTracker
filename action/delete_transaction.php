<?php
// Include database connection
include "../settings/connection.php";

// Check if transactionID is provided
if (isset($_POST['transaction_id'])) {
    // Sanitize and validate transactionID
    $transactionID = mysqli_real_escape_string($con, $_POST['transaction_id']);

    // Perform deletion operation
    $sql = "DELETE FROM Transaction WHERE TransactionID = '$transactionID'";
    if (mysqli_query($con, $sql)) {
        // Respond with success message
        echo "Transaction deleted successfully!";
    } else {
        // If deletion fails, respond with an error message
        echo "Error: " . mysqli_error($con);
    }
} else {
    // If transactionID is not provided, respond with an error message
    echo "TransactionID is required!";
}

// Close database connection
mysqli_close($con);
?>
