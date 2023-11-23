<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profiel Pagina</title>
    <link rel="stylesheet" type="text/css" href="profile.css">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.tailwindcss.com"></script>
	  <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
	<div class="navbar bg-base-100">
	<div class="flex-1">
    <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
    </div>
    <div class="container">
        <h1><strong>Bekijk gegevens van de klanten</strong></h1>
        <?php
    		include "connect.php";
            include "./functions/userFunctions.php";
            include "./functions/sellerFunctions.php";
    		session_start();
    	
            $query = "SELECT * FROM tblgebruikers ORDER BY gebruikerid";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
        echo '





<div class= "pl-10 flex flex-wrap gap-4 ">
<div class=" mr-4 mt-11 w-80 overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md duration-300 hover:scale-105 hover:shadow-lg">
  <img id = "profielFoto"  src="../public/img/'.$row['profielfoto'].'" alt="'.$row['profielfoto'].'" width= "350"/>
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
