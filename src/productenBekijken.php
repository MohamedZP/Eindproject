<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="profile.css">
  <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Producten bekijken</title>
</head>
<body>
  <div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
    </div>

    <?php 
include'connect.php';
  
  if (isset($_POST['search'])) {
    if (!empty($_POST['category']) && !empty($_POST['price'])) {
      $category = $_POST['category'];
      $price = $_POST['price'];
      // Query met categorie en prijs te filteren
      $stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE categorie = ? AND prijs <= ?");
      $stmt->bind_param("si", $category, $price);
      $stmt -> execute();

      $products = $stmt -> get_result();
      
  }elseif (!empty($_POST['price'])) {
    // Enkel de prijs is geselecteerd
    $price = $_POST['price'];
    // Query om enkel op prijs te filteren
    $stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE prijs <= ?");
    $stmt->bind_param("i", $price);
    $stmt -> execute();

    $products = $stmt -> get_result();
  }
  }else{
  // dit laat alle producten zien
  $stmt = $mysqli->prepare("SELECT * FROM tblproducten");
  
  $stmt -> execute();

  $products = $stmt -> get_result();
}
?>

<h1 class="text-center pb-8"><strong>PRODUCTS</strong></h1>

<div class="container mx-5 mt-2">
  <section id="search" class="col-lg-3 col-md-3 col-sm-12">
    <div class="container mt-5 py-5">
        <p>Search Products</p>
        <hr>
        </div>
      <div class="sidebar">
      <form method="post" action="productenBekijken.php">
        <div class="row mx-auto container">
          <div class="col-lg-12 col-md-12 col-sm-12">
            
 
    
            <p>Merken</p>
            <?php  
            $query = "SELECT * FROM tblproducten GROUP BY categorie";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
            echo '

              <div class="form-check">
                <input class="form-check-input" type="radio" value="'.$row['categorie'].'" name="category" id= "category_one"  >
                <label class="form-check-label" for="flexRadioDefault1">
                  '.$row['categorie'].'
                </label>
                
              </div>
              
          ';
            }
              ?>
             
          </div>
        </div>

        


        
        <div class="row mx-auto container mt-5">
          <div class="col-lg-12 col-md-12 col-sm-12">
            
            <p>Prijs</p>
            <input type="range" class="form-range w-50" name="price" value="25000" min="1" max="50000" id="customRange" oninput="var str = document.getElementById('selectedPrice').innerHTML = 'Selected price: €' + this.value">
            <div>
              <span id="selectedPrice">Selected price: €25000</span>
            </div>
          </div>
        </div>

        <div class="row mx-auto container mt-5">
          <input type="submit" name="search" value="search" class="btn btn-primary">
        </div>

      </form>
      </div>
    </section>
	  </div>
    <div>
    <section id="products" class="col-lg-9 col-md-9 col-sm-12">
        <?php
    		include "connect.php";
        include "./functions/userFunctions.php";
    		
    	
        while ($row = $products->fetch_assoc()) {
        echo '
          <div class="row1">
          <div class="column flex space-x-4">
              <div class="card1">
                <img class="w-52 h-60 mb-2 mx-auto mt-4" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'">
                  <div class="card-img-overlay d-flex justify-content-end"></div>
                  <div class="card-body">
                  <h4 class="card-title mx-auto">'.$row['naam'].'</h4>
                  <p class="card-text">'.$row['beschrijving'].'</p>
                  </div>
                  <div class="buy d-flex justify-content-between align-items-center">
                    <div class="price text-success"><h5 class="mt-2">€'.$row['prijs'].'</h5></div>
                    <button class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 mt-3 " name = "add_to_cart"><a href="Singleproduct.php?productid= '.$row["productid"].' " class=" mt-3 mb-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a></button>

                </div>
              </div>
            </div>
                  
        ';
};
?>
       </section>

</body>
</html>