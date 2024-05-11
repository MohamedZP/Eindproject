<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	<?php 
	include "connect.php";
	include "functions/userFunctions.php";
	session_start();
	
	if (isset($_SESSION["login"])) {
    header("location:index.php");
}

if (isset($_POST['submit'])) {
	 if(checkIfAdmin($mysqli,$_POST['email'])){
                $_SESSION["admin"] = "true";
                $_SESSION['gebruikersid'] = getGebruikersid($mysqli,$_POST['email']);
               	$_SESSION["login"]= $_SESSION['gebruikersid'] ;
                header('Location: admin.php');
	}else {

if(isset($_POST['submit'])){
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['wachtwoord'] = $_POST['password'];
    $sql = ("SELECT * FROM tblgebruikers WHERE email='".$_SESSION['email']."' and wachtwoord='".$_SESSION['wachtwoord']."'");
   		$resultaat = $mysqli->query($sql);
			if($resultaat) {
				if (mysqli_num_rows($resultaat) == 1) {
					$_SESSION['gebruikersid'] = getGebruikersid($mysqli,$_POST['email']);
             		$_SESSION["login"]= $_SESSION['gebruikersid'] ;
					
					echo "je bent ingelogd";
					header("Location: index.php");
				
				} else {
					echo '
				<div role="alert" class="alert alert-error">
  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
  <span>Error! Je hebt de verkeerde gegevens ingevuld.
  						Probeer het opnieuw.</span>
</div>
					 ';
			}
    }
}
}
  } 
?>

	
	<h1 class="grid grid-cols-0 place-items-center my-5" >Hier inloggen</h1>
	<div class="grid grid-cols-3 gap-4 place-items-center h-56 w-full">
	<div  class="  col-start-2 my-10 mx-0">
		<div
		class="bg-white shadow-md border border-gray-200 rounded-lg max-w-screen-2xl p-4 sm:p-6 lg:p-8 dark:bg-gray-800 dark:border-gray-700">
		<form class="space-y-6" action="Login.php" method="post">
			<h3 class="text-xl font-medium text-gray-900 dark:text-white ml-12">Log in op onze website</h3>
			<div>
				<label for="email" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Email:</label>
				<input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required="">
            </div>
				<div>
					<label for="password" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Wachtwoord:</label>
					<input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
                </div>
					<div class="flex items-start">
						<div class="flex items-start">
							<div class="flex items-center h-5">
								<input id="remember" aria-describedby="remember" type="checkbox" class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                            </div>
								<div class="text-sm ml-3 mr-11">
									<label for="remember" class="font-medium text-gray-900 dark:text-gray-300">Remember me</label>
								</div>
							</div class = "text-sm ml-10">
							<a href="WijzigenW.php" class="text-sm text-blue-700 hover:underline ml-auto dark:text-blue-500">Wachtwoord vergeten?</a>
						</div>
						<button type="submit" name ="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Inloggen</button>
						<div class="text-sm font-medium text-gray-500 dark:text-gray-300">
							Geen account? <a href="registreren.php" class="text-blue-700 hover:underline dark:text-blue-500 text-left">Registreren</a>
						</div>
		</form>
	
	</div>
	</div>

</div>
</body>
</html>