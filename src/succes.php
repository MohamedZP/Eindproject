<?php
session_start();
include 'connect.php';
$_SESSION['datum'] = date("Y-m-d H:i:s");

$query = "SELECT * from tblcart where gebruikerid ='".$_SESSION['login']."'";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {

      $miniquery = "SELECT * from tblproducten where productid ='".$row['productid']."'";

      $miniresult = $mysqli->query($miniquery);

      while($row2 = $miniresult->fetch_assoc()) {

            $insertQuery = "INSERT INTO tblaankoop(gebruikerid, productid, productnaam, quantity, prijs, totaal, datum)  VALUES ('".$_SESSION['login']."', '".$row['productid']."', '".$row2['naam']."', '".$row['aantal']."', '".$row2['prijs']."', '".$row2['prijs'] * $row['aantal']."', '".$_SESSION['datum']."')";
            if ($mysqli->query($insertQuery)) {

            } else {
                echo "<script>alert('Product is niet verplaatst naar tblaankoop');</script>";
                var_dump($mysqli);
            }
        } 
}
$sql2 = "DELETE FROM tblcart WHERE gebruikerid='".$_GET['userid']."'";
if ($mysqli->query($sql2)) {

} else {
    echo "<script>alert('Product is niet verwijderd uit de cart');</script>";
};
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
  <script src="https://cdn.tailwindcss.com"></script>
    <title></title>
</head>
<body>
<div class="bg-gray-100 ">
      <div class="bg-white p-6  md:mx-auto">
        <svg viewBox="0 0 24 24" class="text-green-600 w-16 h-16 mx-auto my-6">
            <path fill="currentColor"
                d="M12,0A12,12,0,1,0,24,12,12.014,12.014,0,0,0,12,0Zm6.927,8.2-6.845,9.289a1.011,1.011,0,0,1-1.43.188L5.764,13.769a1,1,0,1,1,1.25-1.562l4.076,3.261,6.227-8.451A1,1,0,1,1,18.927,8.2Z">
            </path>
        </svg>
        <div class="text-center">
            <h3 class="md:text-2xl text-base text-gray-900 font-semibold text-center">Payment Done!</h3>
            <p class="text-gray-600 my-2">Thank you for completing your secure online payment.</p>
            <p> Have a great day!</p>
            <div class="flex justify-center my-6">
                <div class="grid h-20 flex-grow card rounded-box place-items-center mx-12">
                <a href="index.php" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-box py-3">GO BACK</a>
                </div>
            
            <div class="divider divider-horizontal"></div>
            
            <?php 
           
                echo '<div class="grid h-20 flex-grow card rounded-box place-items-center mx-2"><label><a class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-box py-3" href="Betalingsbewijs.php?userid='.$_SESSION['login'].'">PROOF OF PAYMENT</a></label></div>';
           
            
        

            ?>
            </div> 
        </div>
    </div>
  </div>
</body>
</html>