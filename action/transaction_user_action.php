<?php

include "../settings/connection.php";
include "../settings/core.php";


if (isset($_POST['submit'])) { 
   
    $amount = mysqli_real_escape_string($con, $_POST["amount"]);
    $transaction_date = mysqli_real_escape_string($con, $_POST["transactionDate"]);
    $transaction_type = mysqli_real_escape_string($con, $_POST["transactionType"]);
    $description = mysqli_real_escape_string($con, $_POST["description"]);
    $person_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    // Validating inputs
    if (!is_numeric($amount) || $amount <= 0) {
        echo "Invalid amount.";
        exit;
    }

    $transactionQuery = "INSERT INTO Transaction (UserID, Amount, TransactionDate, Description, CategoryName)
                        VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $transactionQuery);
    mysqli_stmt_bind_param($stmt, "idsss", $person_id, $amount, $transaction_date, $description, $transaction_type);
    
    if (!mysqli_stmt_execute($stmt)) {
        echo "Error: " . mysqli_error($con);
        exit;
    }

    // Retrieving CategoryID for provided CategoryName
    $getCategoryIDQuery = "SELECT CategoryID FROM Category WHERE CategoryName = ? AND UserID = ?";
    $stmt = mysqli_prepare($con, $getCategoryIDQuery);
    mysqli_stmt_bind_param($stmt, "si", $transaction_type, $person_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $categoryID = $row['CategoryID'];

       
        $updateBudgetQuery = "UPDATE Budget SET AmountLeft = AmountLeft - ? WHERE CategoryID = ?";
        $stmt = mysqli_prepare($con, $updateBudgetQuery);
        mysqli_stmt_bind_param($stmt, "di", $amount, $categoryID);

        if (!mysqli_stmt_execute($stmt)) {
            echo "Error updating Budget: " . mysqli_error($con);
            exit;
        } else {

            // Calculating total transactions
            $totalTransactionQuery = "SELECT SUM(Amount) AS total FROM Transaction WHERE UserID = ?";
            $stmt = mysqli_prepare($con, $totalTransactionQuery);
            mysqli_stmt_bind_param($stmt, "i", $person_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $totalTransactionAmount = $row['total'];
                
                // Storing total transaction amount in session variable
                $_SESSION['totalTransactionAmount'] = $totalTransactionAmount;
            } else {
                echo "No transactions found.";
            }

            header("Location: ../view/main.php");
            exit;
        }
    } else {
        echo "Category not found or not associated with the user.";
        exit;
    }
} else {
    echo "No form submission detected.";
}
?>