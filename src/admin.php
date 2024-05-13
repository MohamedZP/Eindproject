<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MoWatch</title>
  <link rel="stylesheet" type="text/css" href="profile.css">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
      <?php   
      include "connect.php";
      include "./functions/userFunctions.php";
        
      session_start();

      	if (!isset($_SESSION["login"])) {
      	      echo '<div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
          <img src="/Eindproject/public/img/profile_picture">
        </div>
      </label>
             <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="Login.php">Login</a><li>
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
        <li><a href= "gegevensBekijken.php">Klanten bekijken</a></li>
        <li><a href= "productToevoegen.php">Product Toevoegen</a></li>
         <li>
          <a href = "BetalingenAdmin.php" >
            Betalingen
          </a>
        </li>
        <li><a href="loguit.php">Logout</a></li>
      </ul>
    ';
}

?>
</div>
  </div>
</div>
        <?php
      
            $sql = "SELECT * FROM tblproducten ORDER BY productid";
            $result = $mysqli->query($sql);
            while ($row = $result->fetch_assoc()) {
        echo '

        <div class="row1">
        <div class="column"> 
                <div class="card1 mr-11 h-full">
                    <img class="w-52 h-60 mb-2 mx-auto mt-4" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'">
                    <div class="card-img-overlay d-flex justify-content-end"></div>
                    <div class="card-body">
                        <h4 class="card-title mx-auto">'.$row['naam'].'</h4>
                        <p class="card-text">'.$row['beschrijving'].'</p>
                    </div>
                    <div class="buy d-flex justify-content-between align-items-center">
                        <div class="price text-success"><h5 class="mt-2">€'.$row['prijs'].'</h5></div>
                        <div class="card-body items-center text-center">
                            <div class="card-actions justify-end">
                            <div class="flex">
                              <div class="w-1/2 mr-1">
                                <a href="Wijzigen.php?productid=' . $row['productid'] . '"><button class="btn btn-primary">Wijzigen</button></a>
                                 </div>
                                 <div class="w-1/2 ml-1">
                                <a href="deleteP.php?productid=' . $row['productid'] . '"><button class="btn btn-primary">Verwijderen</button></a>
                            </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

      
        ';
};
?>
</body>
</html>

