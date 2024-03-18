<?php
include "../settings/connection.php";

if (isset($_GET['transaction_id'])) {
    $transactionID = mysqli_real_escape_string($con, $_GET['transaction_id']);
    
    $sql = "SELECT * FROM Transaction WHERE TransactionID = '$transactionID'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $transaction = mysqli_fetch_assoc($result);
        echo json_encode($transaction);
    } else {
        echo json_encode(array("error" => "Transaction not found"));
    }
} else {
    echo json_encode(array("error" => "Transaction ID not provided"));
}

mysqli_close($con);
?>
