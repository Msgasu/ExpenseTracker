<?php


function getcategory($id){
    include("../settings/connection.php");

    $query = "SELECT * FROM Category WHERE CategoryID = '$id'";
    $result = $mysqli->query($query); 

    if (!$result) {
        die("Error executing query: " . $mysqli->error);
    }

    $Retrieved= mysqli_fetch_assoc($result);

    $mysqli->close();

    return $Retrieved;
}



?>
