<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profiel Pagina</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
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
        <h1>Bekijk de klanten</h1>
        <?php
    		include "connect.php";
            include "./functions/userFunctions.php";
            include "./functions/sellerFunctions.php";
    		session_start();
    	
            $query = "SELECT * FROM tblgebruikers ORDER BY gebruikerid";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_assoc()) {
        echo '

        <div class="profile">
            <h2>Klant gegevens</h2>
            <p><strong>Voornaam:</strong> '. $row['voornaam'] . '</p> 
            <p><strong>Achternaam:</strong>'  . $row['naam'] . '</p>
            <p><strong>Wachtwoord:</strong> ' . $row['wachtwoord'] . '</p>
            <p><strong>E-mail:</strong> ' . $row['email'] . '</p>
            <p><strong>Profielfoto:</strong> ' . $row['profielfoto'] . '</p>
            <p><strong>Beshrijving:</strong>' . $row['beschrijving'] . '</p>
            </div>';
};

     ?>
</body>
</html>


</body>
</html>