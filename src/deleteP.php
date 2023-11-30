<?php
include "connect.php";

$sql = "DELETE FROM tblproducten WHERE productid = " . $_GET["productid"] . "";
$mysqli->query($sql);

header("location: admin.php");
  ?>