<?php
include "../settings/connection.php";
include "../settings/core.php";

if (isset($_POST['submit'])) {
 
    $categoryName = $_POST['category-name'];
    $categoryIcon = $_POST['category-icon'];
    $person_id = $_SESSION['user_id'];

   
    $categoryQuery = "INSERT INTO Category (CategoryName, CategoryIcon, UserID)
                      VALUES ('$categoryName', '$categoryIcon','$person_id')";

    if (mysqli_query($con, $categoryQuery)) {
        $lastCategoryID = mysqli_insert_id($con);
        $_SESSION['lastCategoryID'] = $lastCategoryID;

        $amount = $_POST['category-amount'];
        $amountLeft = $_POST['category-amount']; // setting the initial budget amount to the amount left Category. Changes will be made with each transaction

       
        $totalBudgetQuery = "SELECT SUM(Amount) AS total FROM Budget WHERE CategoryID IN (SELECT CategoryID FROM Category WHERE UserID = '$person_id')";
        $totalBudgetResult = mysqli_query($con, $totalBudgetQuery);
        $totalBudgetRow = mysqli_fetch_assoc($totalBudgetResult);
        $totalbudget = $totalBudgetRow['total'];

        $budgetQuery = "INSERT INTO Budget (Amount, AmountLeft, CategoryID,UserID)
                        VALUES ('$amount', '$amountLeft','$lastCategoryID','$person_id')";

        if (!mysqli_query($con, $budgetQuery)) {
            echo "There seems to be an issue with the Budget insertion";
        } else {

            $_SESSION['totalbudget'] = $totalbudget; // Storing total budget in session variable
            header("Location: ../view/main.php");
            exit(); 
        }
    } else {
        echo "There seems to be an issue with the Category insertion";
    }
} else {
    echo "Something went wrong";
}
?>