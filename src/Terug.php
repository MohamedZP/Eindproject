<?php
include "connect.php";
include "./functions/userFunctions.php";
        
      session_start();
      if(!isset($_SESSION["admin"])){
      header('location: index.php');
      return;
    };

$sql = "UPDATE tblgebruikers SET Verwijderd = 0 WHERE gebruikerid = " . $_GET["gebruikerid"] . "";

if ($mysqli->query($sql)) {
  header("location: admin.php");
}else{
  echo "niet gelukt";
}


  ?>