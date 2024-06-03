<?php
include "connect.php";
   include "./functions/userFunctions.php";
        
      session_start();
      if(!isset($_SESSION["admin"])){
      header('location: index.php');
      return;
    };
$sql = "UPDATE tblproducten SET Verwijderd = 0 WHERE productid = " . $_GET["productid"] . "";

if ($mysqli->query($sql)) {
  header("location: admin.php");
}else{
  echo "niet gelukt";
}


  ?>