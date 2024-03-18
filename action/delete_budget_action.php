<?php
// Include database connection
include "../settings/connection.php";

// Check if budgetID is provided
if (isset($_POST['budget-id'])) {
    // Sanitize and validate budgetID
    $budgetID = mysqli_real_escape_string($con, $_POST['budget-id']);

    // Fetch the category ID associated with the budget
    $categoryID_query = "SELECT CategoryID FROM Budget WHERE BudgetID = '$budgetID'";
    $categoryID_result = mysqli_query($con, $categoryID_query);

    if ($categoryID_result && mysqli_num_rows($categoryID_result) > 0) {
        $categoryID_row = mysqli_fetch_assoc($categoryID_result);
        $categoryID = $categoryID_row['CategoryID'];

        // Delete the budget associated with the given budgetID
        $delete_budget_sql = "DELETE FROM Budget WHERE BudgetID = '$budgetID'";
        if (mysqli_query($con, $delete_budget_sql)) {
            // If budget was deleted, attempt to delete the associated category
            $delete_category_sql = "DELETE FROM Category WHERE CategoryID = '$categoryID'";
            if (mysqli_query($con, $delete_category_sql)) {
                // If category deletion was successful, respond with success message
                echo "Budget and its associated category deleted successfully!";
                // header('Location: ../view/main.php');
            } else {
                // If category deletion fails, respond with an error message
                echo "Error deleting category: " . mysqli_error($con);
            }
        } else {
            // If deletion of budget fails, respond with an error message
            echo "Error deleting budget: " . mysqli_error($con);
        }
    } else {
        // If no category ID found, respond with appropriate message
        echo "No category found for the provided budget ID!";
    }
} else {
    // If budgetID is not provided, respond with an error message
    echo "budgetID is required!";
}

// Close database connection
mysqli_close($con);
?>
