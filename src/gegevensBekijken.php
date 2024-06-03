<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profiel Pagina</title>
    <link rel="stylesheet" type="text/css" href="profile.css">

	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
   
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	 <div class="navbar bg-base-100 ">
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
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="/Eindproject/public/img/profile_picture">
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="Login.php">Login</a></li>
                </ul>
            </div>';
        } else {
            $userid = $_SESSION["login"];
            $profielfoto = getProfilePicture($mysqli, $userid);
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="../public/img/'.$profielfoto.'"/>
                    </div>
                </label>  
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="gegevensBekijken.php">Klanten bekijken</a></li>
                    <li><a href="productToevoegen.php">Product Toevoegen</a></li>
                    <li><a href="BetalingenAdmin.php">Bestellingen van klanten</a></li>
                    <li><a href="Dashboard.php">Dashboard</a></li>
                    <li><a href="verwijderdeK.php">Verwijderde klanten</a></li>
                    <li><a href="verwijderdeP.php">Verwijderde Producten</a></li>
                    <li><a href="Loguit.php">Log uit</a></li>
                </ul>
            </div>';
        }
        ?>
    </div>
    
        <h1 class="text-center pb-8"><strong>Bekijk gegevens van de klanten</strong></h1>
        <?php
    		
    		    	
            $query = "SELECT * FROM tblgebruikers WHERE admin=0 AND verwijderd = 0";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
        echo '




<div class="column flex  pr-2 ps-6">
<div class="card1 mr-11 h-full">
  <img class="w-screen h-52  mx-auto  mt-2" id = "profielFoto"  src="../public/img/'.$row['profielfoto'].'" alt="'.$row['profielfoto'].'"/>
  <br>
  <div class="p-4">
  <h1><strong> '.$row['voornaam'] .' '.$row['naam'] . '</strong></h1>
  <br>
  <p class="title">' . $row['email'] . '</p>
  <br>
  <p> ' . $row['beschrijving'] . '</p>
  <br>
  <br>
  <a href = "deleteU.php?gebruikerid=' . $row['gebruikerid'] . '"><button class = "btn btn-primary flex-1">Verwijderen</button></a>
</div>
</div>
</div>


        ';
};


     ?>


</body>
</html>
