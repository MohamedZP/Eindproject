<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Producten bekijken</title>
</head>
<body >

  <div class="navbar bg-base-100">
    <div class="flex-1">
      <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
    </div>
  </div>


    <?php 
include'connect.php';
  
  if (isset($_POST['filter'])) {
    if (!empty($_POST['category']) && !empty($_POST['price'])) {
      $category = $_POST['category'];
      $price = $_POST['price'];
      // Query met categorie en prijs te filteren
      $stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE categorie = ? AND prijs <= ? AND Verwijderd = 0");
      $stmt->bind_param("si", $category, $price);
      $stmt -> execute();

      $products = $stmt -> get_result();
      
  }elseif (!empty($_POST['price'])) {
    // Enkel de prijs is geselecteerd
    $price = $_POST['price'];
    // Query om enkel op prijs te filteren
    $stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE prijs <= ? AND Verwijderd = 0");
    $stmt->bind_param("i", $price);
    $stmt -> execute();

    $products = $stmt -> get_result();
  }
  }else{
  // dit laat alle producten zien
  $stmt = $mysqli->prepare("SELECT * FROM tblproducten WHERE Verwijderd = 0");
  
  $stmt -> execute();

  $products = $stmt -> get_result();
}
?>

<h1 class="text-center pb-8"><strong>PRODUCTEN</strong></h1>

  <div class="container mx-auto px-4">
    <div class="flex flex-wrap lg:flex-nowrap">
      <section id="search" class="w-full lg:w-1/4 mb-8 lg:mb-0 lg:mr-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
          <p class="text-xl font-semibold">Filter</p>
          <hr class="my-4">
          
          <form method="post" action="productenBekijken.php">
            <div>
              <p class="font-semibold">Merken</p>
            <?php  
            $query = "SELECT * FROM tblproducten GROUP BY categorie";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
            echo '

              <div class="form-check mb-2">
                <input class="form-check-input" type="radio" value="'.$row['categorie'].'" name="category" id= "category_one"  >
                

                <label class="form-check-label" for="flexRadioDefault1">
                  '.$row['categorie'].'
                </label>
                
              </div>
              
          ';
            }
              ?>
             
          </div>

            <div class="mt-6">
              <p class="font-semibold">Prijs</p>
              <input type="range" class="form-range w-full" name="price" value="50000" min="1" max="100000" id="customRange" oninput="document.getElementById('selectedPrice').innerHTML = 'Selected price: €' + this.value">
              <div class="mt-2">
                <span id="selectedPrice">Geselecteerde prijs: €50000</span>
              </div>
            </div>

            <div class="mt-6">
              <input type="submit" name="filter" value="Filter" class="btn btn-primary w-full">
            </div>
          </form>
        </div>
      </section>

      <section id="products" class="w-full lg:w-3/4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                 <?php
          include "connect.php";
          include "./functions/userFunctions.php";

          while ($row = $products->fetch_assoc()) {
            echo '
              <div class="product-card p-6 bg-white rounded-lg shadow-md flex flex-col items-center">
                <img class="w-52 h-52 mb-4" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'">
                <h4 class="text-xl font-semibold mb-2 text-center">'.$row['naam'].'</h4>
                <p class="text-gray-700 mb-4 text-center">'.$row['beschrijving'].'</p>
                <div class="mt-auto text-center">
                  <span class="text-xl font-bold text-green-600 block mb-2">€'.$row['prijs'].'</span>
                  <a href="Singleproduct.php?productid='.$row["productid"].'" class="btn btn-primary">Add to Cart</a>
                </div>
              </div>
            ';
          }
            ?>
           </div>
      </section>
    </div>
  </div>

</body>
</html>