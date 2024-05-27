<?php
include "connect.php";

$sql = "DELETE FROM tblproducten WHERE productid = ?";
$stmt = $mysqli->prepare($sql);

if ($stmt) {

    $stmt->bind_param("i", $_GET["productid"]);
    
    
    $stmt->execute();
}
header("location: admin.php");
  ?>