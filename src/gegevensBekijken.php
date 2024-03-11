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
	<div class="navbar bg-base-100">
	<div class="flex-1">
    <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
    </div>
    
        <h1 class="text-center pb-8"><strong>Bekijk gegevens van de klanten</strong></h1>
        <?php
    		include "connect.php";
            include "./functions/userFunctions.php";
    		session_start();
    	
            $query = "SELECT * FROM tblgebruikers WHERE admin=0";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
        echo '



<div class="row1">
<div class="column flex space-x-4">
<div class="card1 ">
  <img class="w-screen h-52  mx-auto  mt-2" id = "profielFoto"  src="../public/img/'.$row['profielfoto'].'" alt="'.$row['profielfoto'].'"/>
  <br>
  <div class="p-4">
  <h1><strong> '.$row['voornaam'] .' '.$row['naam'] . '</strong></h1>
  <br>
  <p class="title">' . $row['email'] . '</p>
  <br>
  <p>Wachtwoord: ' . $row['wachtwoord'] . '</p>
  <br>
  <p> ' . $row['beschrijving'] . '</p>
  <br>
  <br>
  <a href = "deleteU.php?gebruikerid=' . $row['gebruikerid'] . '"><button>Verwijderen</button></a>
</div>
</div>
</div>

        ';
};


     ?>


</body>
</html>
