<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<?php
include "connect.php";
include "functions/userFunctions.php";
        if(isset($_POST['submit'])) {
                $voornaam = $_POST['fname'];
                $achternaam = $_POST['name'];
                $wachtwoord = $_POST['password'];
                $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
                $email = $_POST['email'];
                $beschrijving = $_POST['beschrijving'];
                $upload_dir= $_SERVER['DOCUMENT_ROOT']."/Eindproject/public/img/";
 		$file_name= $_FILES['file']['name'];
  		$file_tmp= $_FILES['file']['tmp_name'];
  		if((empty($_POST['file']))){
   		 move_uploaded_file($file_tmp,$upload_dir.$file_name);
  		}

  	$sql = "INSERT INTO tblgebruikers(voornaam , naam , wachtwoord, email, profielfoto, beschrijving,admin, verwijderd) VALUES ('".$voornaam."', '".$achternaam."', '".$wachtwoord."', '".$email."', '".$file_name."','".$beschrijving."', 0,0)";
  			
  		if($mysqli->query($sql)){
 		
 		header("Location: login.php");

        }else{
                echo "Error record toevoegen" .$mysqli->error;
               



        }
        
}

                
            
        
    ?>



<h1 class="grid grid-cols-0 place-items-center my-5" >Account aanmaken</h1>
	<div class="grid grid-cols-3 gap-4 place-items-center ">
	<div  class="  col-start-2 my-10 min-h-screen ">
		<div
		class="bg-white shadow-md border border-gray-200 rounded-lg max-w-screen-2xl p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700   ">
		<form class="space-y-6" action="registreren.php" method="post" enctype="multipart/form-data">
		<h3 class="text-xl font-medium text-gray-900 dark:text-white ml-14 w-80">Registreer op onze website</h3>
	<div>
		<label for="fname" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Voornaam:</label>
		<input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Steven" required="">
        </div>
        <div>
		<label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Achternaam:</label>
		<input type="text" name="name" id="name" placeholder="Peeters" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
	</div>
	<div>
		<label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Wachtwoord:</label>
		<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
	</div>
	<div>
		<label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Email:</label>
		<input type="email" name="email" id="email" placeholder="name@company.com" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
	</div>
	<div>
		<label for="profilePicture" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Profielfoto:</label>
		<input type="file" name="file" id="file" placeholder="image" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
        </div>
        <div>
		<label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Beschrijving:</label>
		<input type="text" name="beschrijving" id="beschrijving" placeholder="Beschrijving" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
       	</div>
		<button type="submit" name ="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Account aanmaken</button>
		<br>
		<div class="text-sm font-medium text-gray-500 dark:text-gray-300">Al een account?<a href="Login.php" class="text-blue-700 hover:underline dark:text-blue-500">Inloggen</a>
</div>
</form>
	

</div>
</div>
</div>
</body>
</html>