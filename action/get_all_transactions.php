<?php
include_once "../settings/core.php";
function fetch_results(){

   include "../settings/connection.php";

   $person_id = $_SESSION['user_id'];
   $query = "SELECT * FROM Transaction WHERE UserID = ?";
   $stmt = $con->prepare($query);
   $stmt->bind_param("i", $person_id);
   $stmt->execute();
   $result = $stmt->get_result();

   if (!$result) {
      die("Error: " . $con->error);
   }

   $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

   $stmt->close();

   $con->close();

   return $data;  
}

?>