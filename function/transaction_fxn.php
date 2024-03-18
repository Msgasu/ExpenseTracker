<?php include  "../action/get_all_transactions.php";

function display_table(){
    $var_data = fetch_results();
    foreach ($var_data as $row) {
        echo '<tr>';
        echo '<td>' . $row['TransactionID'] . '</td>'; 
        echo '<td>' . $row['CategoryName'] . '</td>';
        echo '<td>' . $row['Amount'] . '</td>';
        echo '<td>' . $row['TransactionDate'] . '</td>';
        echo '<td>' . $row['Description'] . '</td>';
        echo '<td>';
        echo '<button class="edit-button" onclick="openEditModal(' . $row['TransactionID'] . ')"><i class="material-icons-sharp">edit</i></button>';
        echo '<button class="delete-button" data-id="' . $row['TransactionID'] . '"><i class="material-icons-sharp">delete</i></button>';
        echo '</td>';
        echo '</tr>';
    }


}

?>
