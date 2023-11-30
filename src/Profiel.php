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
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
    </div>
    <div class="container">
        <?php
    		include "connect.php";
            include "./functions/userFunctions.php";
            
    		session_start();
    	
            if(!isset($_SESSION["login"])){
            header('location: index.php');
            }

if (isset($_POST["submit"])) {
    $userid = $_POST["userid"];
    $voornaam = $_POST["voornaam"];
    $naam = $_POST["naam"];
    $wachtwoord = $_POST["wachtwoord"];
    $email = $_POST["email"];
    $beschrijving = $_POST["beschrijving"]; 
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/Eindproject/public/img/";
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (filesize($file_name) <= 0) {
      echo "Error";
    }
      if (!(move_uploaded_file($file_tmp, $upload_dir . $file_name))) {
        echo "Error, kon de foto niet verplaatsen.";
      };
    
    if(updateUser($mysqli,$userid ,$voornaam, $naam, $email, $wachtwoord, $file_name, $beschrijving)){
        header('location: index.php');
    }else{
        print $mysqli->error;
    }


}
    $userid = $_GET['gebruikerid'];
    foreach(getUser($mysqli,$userid) as $row){

        
        echo '<div>
    
    <form class="form-control h-full flex items-center justify-center" action="Profiel.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="userid" value="'.$userid.'">
      <div class="card w-full max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4">Profiel</h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Voornaam</label>
              <input type="text" name="voornaam" placeholder="Voornaam" value = "'.$row["voornaam"].'" class="input input-bordered w-full max-w-md text-black bg-white" required  />
            </div>

            <div class="flex flex-col w-full"> 
              <label class="label text-black">Achternaam</label>
              <input type="text" name="naam" placeholder="Achternaam" value = "'.$row["naam"].'" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
            </div>

             <div class="flex flex-col w-full"> 
              <label class="label text-black">Wachtwoord</label>
              <input type="text" name="wachtwoord" placeholder="Wachtwoord" value = "'.$row["wachtwoord"].'" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>

             <div class="flex flex-col w-full"> 
              <label class="label text-black">E-mail</label>
              <input type="text" name="email" placeholder="E-mail" value = "'.$row["email"].'" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Beschrijving</label>
              <textarea class="textarea textarea-bordered h-24  text-black bg-white" name="beschrijving" placeholder="Beschrijving"  required>'.$row["beschrijving"].'</textarea>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Profiel foto</label>
              <input type="file" name="file" class="file-input file-input-bordered bg-white text-black" value = "'.$row["profielfoto"].'" />
            </div>
          </div>
          ';
           
       }
          ?>
          <button type="submit" name ="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Wijzigen</button>
        
      
        </div>
      </div>
    </form>
  </div>


         
</body>
</html>