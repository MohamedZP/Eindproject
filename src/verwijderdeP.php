<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Verwijderde Producten</title>
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
      <?php   
      include "connect.php";
      include "./functions/userFunctions.php";
        
      session_start();
      if(!isset($_SESSION["admin"])){
      header('location: index.php');
      return;
    };

        if (!isset($_SESSION["login"])) {
              echo '<div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img src="/public/img/profile_picture">
        </div>
      </label>
             <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="login.php">Login</a><li>
        </ul>
       ';
       }else{

          echo '
                <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">';

           $userid = $_SESSION["login"];
          $profielfoto = getProfilePicture($mysqli, $userid);
          echo '<img src="../public/img/'.$profielfoto.'"/>';

        echo '
        </div>
      </label>  
          <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="gegevensBekijken.php">Klanten bekijken</a></li>
                    <li><a href="productToevoegen.php">Product Toevoegen</a></li>
                    <li><a href="betalingenAdmin.php">Bestellingen van klanten</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="verwijderdeK.php">Verwijderde klanten</a></li>
                    <li><a href="verwijderdeP.php">Verwijderde Producten</a></li>
                    <li><a href="loguit.php">Log uit</a></li>
                </ul>
    ';
}

?>
</div>
  </div>
</div>
<h1 class="text-center pb-8"><strong>Bekijk de verwijderde producten</strong></h1>
<div class="container mx-auto px-4 mt-8">
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php
        $sql = "SELECT * FROM tblproducten WHERE Verwijderd = 1 ORDER BY productid";
        $stmt = $mysqli->prepare($sql);

        // Voer de query uit
        $stmt->execute();

        // Verkrijg het resultaat
        $result = $stmt->get_result();

        // Verwerk het resultaat
        while ($row = $result->fetch_assoc()) {
          echo '
          <div class="card bg-white rounded-lg shadow-md p-4 flex flex-col justify-between">
              <img class=" h-full object-cover mb-4 rounded" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'">
              <div class="card-body flex flex-col justify-between">
                  <h4 class="card-title text-xl font-semibold">'.$row['naam'].'</h4>
                  <p class="card-text text-gray-700 mb-4">'.$row['beschrijving'].'</p>
                  <div class="flex justify-between items-center">
                      <div class="price text-green-600 text-lg font-bold">€'.$row['prijs'].'</div>
                  </div>
                  <div class="flex mt-4 space-x-2">
                    
                      <a href = "terug2.php?productid=' . $row['productid'] . '" class="btn btn-primary flex-1"><button>Terugbrengen</button></a>
                  </div>
              </div>
          </div>
          ';
        }
        ?>
  </div>
</div>

</body>
</html>