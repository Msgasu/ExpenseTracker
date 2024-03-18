<?php
include_once "../action/get_budgets.php";

function display_budget_table() {
    list($categoryData, $budgetData) = fetch_budget_results();

    foreach ($categoryData as $category) {
        echo '<tr>';
        echo '<td>' . $category['CategoryName'] . '</td>';
        $budgetRow = findBudgetData($budgetData, $category['CategoryID']);
        echo '<td>' . $budgetRow['Amount'] . '</td>';
        echo '<td>' . $budgetRow['AmountLeft'] . '</td>';
        echo '<td>';
        // Iterate over the budget data specific to the current category
        foreach ($budgetData as $budget) {
            if ($budget['CategoryID'] == $category['CategoryID']) {
                echo '<button class="edit-button" onclick="openEditModal(' . $budgetRow['BudgetID'] . ')"><i class="material-icons-sharp">edit</i></button>';
                echo '<button class="delete-button" data-id="' . $budgetRow['BudgetID'] . '"><i class="material-icons-sharp">delete</i></button>';
            }
        }
        echo '</td>';
        echo '</tr>';
    }
}

// Function to find budget data for a specific category ID
function findBudgetData($budgetData, $categoryID) {
    foreach ($budgetData as $budget) {
        if ($budget['CategoryID'] == $categoryID) {
            return $budget;
        }
    }
    // Return some default value or handle the case where no matching data is found
    return array();
}
?>