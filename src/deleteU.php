<?php
include "connect.php";

$sql = "DELETE FROM tblgebruikers WHERE gebruikerid = " . $_GET["gebruikerid"] . "";
$mysqli->query($sql);

header("location: admin.php");
  ?>