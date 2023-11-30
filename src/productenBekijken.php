<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="profile.css">
	<script src="https://cdn.tailwindcss.com"></script>
	<title>Producten bekijken</title>
</head>
<body>
  <div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
    </div>
	 <h1 class="text-center pb-8"><strong>Bekijk de producten</strong></h1>
        <?php
    		include "connect.php";
        include "./functions/userFunctions.php";
    		session_start();
    	
            $query = "SELECT * FROM tblproducten ORDER BY productid";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
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
                    <button class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-700 mt-3"><a href="#" class=" mt-3 mb-3"><i class="fas fa-shopping-cart"></i> Add to Cart</a></button>
                </div>
              </div>
            </div>
                  
        ';
};
?>
</body>
</html>