<?php

include_once "../settings/core.php";  

function fetch_budget_results() {
    include "../settings/connection.php";


    $person_id = $_SESSION['user_id'];

    $categoryQuery = "SELECT * FROM Category WHERE UserID = ?";
    $categoryStmt = $con->prepare($categoryQuery);
    $categoryStmt->bind_param("i", $person_id);
    $categoryStmt->execute();
    $categoryResult = $categoryStmt->get_result();

    
    $budgetQuery = "SELECT * FROM Budget WHERE UserID = ?";
    $budgetStmt = $con->prepare($budgetQuery);
    $budgetStmt->bind_param("i", $person_id);
    $budgetStmt->execute();
    $budgetResult = $budgetStmt->get_result();

    if (!$categoryResult || !$budgetResult) {
        
        die("Error: " . $con->error);
    }


    $categoryData = $categoryResult->fetch_all(MYSQLI_ASSOC);
    $budgetData = $budgetResult->fetch_all(MYSQLI_ASSOC);


    $categoryStmt->close();
    $budgetStmt->close();
    $con->close();

    return array($categoryData, $budgetData);
}

?>