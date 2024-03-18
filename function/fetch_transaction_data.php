<?php
include "../settings/connection.php";
include "../settings/core.php";
$person_id = $_SESSION['user_id'];


// Fetch total amount spent per category, handling negative amounts left
$sql = "SELECT c.CategoryName, 
        SUM(CASE WHEN b.AmountLeft >= 0 THEN (b.Amount - b.AmountLeft)
                ELSE (b.Amount + ABS(b.AmountLeft))
            END) AS TotalAmount
        FROM Category c
        LEFT JOIN Budget b ON c.CategoryID = b.CategoryID
        WHERE c.UserID = '$person_id'
        GROUP BY c.CategoryName";

$result = mysqli_query($con, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $categories = array();
    $amounts = array();

    while($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['CategoryName'];
        $amounts[] = floatval($row['TotalAmount']);
    }

    $data = array(
        "labels" => $categories,
        "data" => $amounts
    );

    echo json_encode($data);
} else {
    echo json_encode(array("error" => "No data found"));
}

mysqli_close($con);
?>
