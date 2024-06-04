<?php 
include'connect.php';

  session_start();
	if(!isset($_SESSION['login'])){
  header('location: index.php');
  return;
};



if (isset($_GET['productid'])) {
	$productid = $_GET['productid'];

	$stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE productid = ?");
	$stmt -> bind_param("i",$productid );
	
	$stmt -> execute();


	$product = $stmt -> get_result();
}else{
	//no productid
	header('location: index.php');
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet"  type="text/css" href="style.css"> 
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
	
	<title>Product</title>
</head>
<body>

<section class="container single-product my-5 pt-5">
	<div class="row mt-5">

		<?php
		while ($row = $product->fetch_assoc()) { 

		echo '
		
		<div class="col-lg-5 col-md-6 col-sm-12">
			<img class="img-fluid w-100 pb-1" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].' id="mainImg" />	
		</div>
	 

<div class="col-lg-6 col-md-12 col-12">
	<h6>Horloge</h6>
	<h3 class="py-4">'.$row['naam'].'</h3>
	<h2>€ '.$row['prijs'].'</h2>
	<form method="post" action="cart.php">
	<input type="hidden" name="productid" value="'.$row['productid'].'">	
	<input type="hidden" name="image" value="'.$row['foto'].'">	
	<input type="hidden" name="name" value="'.$row['naam'].'">
	<input type="hidden" name="price" value="'.$row['prijs'].'">
	<input type="number" name = "quantity" value="1" min = 1>
	<button class="buy-btn" type = "submit" name = "add_to_cart">In winkelwagen</button>
	</form>
	<h4 class="mt-5 mb-5">Product beschrijving</h4>
	<span> '.$row['beschrijving'].'</span>
</div>


';
} ?>
</section>	




</body>
</html>
