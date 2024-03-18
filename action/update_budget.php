<?php
// Include database connection
include "../settings/connection.php";

// Check if budgetID, amount, and categoryName are provided
if (isset($_POST['budget-id'], $_POST['amount'], $_POST['category-name'])) {
    // Sanitize and validate inputs
    $budgetID = mysqli_real_escape_string($con, $_POST['budget-id']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $categoryName = mysqli_real_escape_string($con, $_POST['category-name']);

    // Update budget amount
    $update_budget_sql = "UPDATE Budget SET Amount = '$amount' WHERE BudgetID = '$budgetID'";
    if (mysqli_query($con, $update_budget_sql)) {
        // If budget amount is updated successfully, proceed to update category name
        $update_category_sql = "UPDATE Category SET CategoryName = '$categoryName' WHERE CategoryID = (
            SELECT CategoryID FROM Budget WHERE BudgetID = '$budgetID'
        )";
        if (mysqli_query($con, $update_category_sql)) {
            // If category name is updated successfully, respond with success message
            echo "Budget amount and category name updated successfully!";
        } else {
            // If category name update fails, respond with an error message
            echo "Error updating category name: " . mysqli_error($con);
        }
    } else {
        // If budget amount update fails, respond with an error message
        echo "Error updating budget amount: " . mysqli_error($con);
    }
} else {
    // If any of the required parameters are not provided, respond with an error message
    echo "budgetID, amount, and categoryName are required!";
}

// Close database connection
mysqli_close($con);
?>
