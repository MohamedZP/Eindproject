<?php
include "connect.php";

$sql = "UPDATE tblgebruikers SET Verwijderd = 0 WHERE gebruikerid = " . $_GET["gebruikerid"] . "";

if ($mysqli->query($sql)) {
  header("location: admin.php");
}else{
  echo "niet gelukt";
}


  ?>