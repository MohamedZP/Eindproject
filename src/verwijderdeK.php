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
    
        <h1 class="text-center pb-8"><strong>Bekijk de verwijderde klanten</strong></h1>
        <?php
    		include "connect.php";
            include "./functions/userFunctions.php";
    		session_start();
    	
            $query = "SELECT * FROM tblgebruikers WHERE admin=0 AND verwijderd = 1";
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
  <a href = "Terug.php?gebruikerid=' . $row['gebruikerid'] . '"><button>Terugbrengen</button></a>
</div>
</div>
</div>


        ';
};


     ?>


</body>
</html>
