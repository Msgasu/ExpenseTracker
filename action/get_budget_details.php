<?php
include "../settings/connection.php";

if (isset($_GET['budget-id'])) {
    $budgetID = mysqli_real_escape_string($con, $_GET['budget-id']);
 
    // Fetch budget data
    $sql = "SELECT * FROM Budget WHERE BudgetID = '$budgetID'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $budget = mysqli_fetch_assoc($result);

        // Fetch category name
        $sql2 = "SELECT CategoryName FROM Category 
                 WHERE CategoryID = (
                     SELECT CategoryID
                     FROM Budget
                     WHERE BudgetID = '$budgetID'
                 )";
        $categoryResult = mysqli_query($con, $sql2);
        
        if ($categoryResult && mysqli_num_rows($categoryResult) > 0) {
            $category = mysqli_fetch_assoc($categoryResult);
            // Merge category name into budget array
            $budget['CategoryName'] = $category['CategoryName'];
        }

        echo json_encode($budget);
    } else {
        echo json_encode(array("error" => "budget not found"));
    }
} else {
    echo json_encode(array("error" => "budget ID not provided"));
}

mysqli_close($con);
?>
