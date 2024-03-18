<?php include_once '../settings/connection.php';

$category = "SELECT * FROM Category"; 
    $result = $con->query($category); 
    $q_result = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $q_result;
    $con->close();
   
   
?> 