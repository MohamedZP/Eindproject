<?php session_start(); ?>

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
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>
  <div class="flex-1">
    <a href="productenBekijken.php" class="menu menu-horizontal px-28 text-xl">Producten</a>
  </div>
  <div class="form-control">
      <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
    </div>
  <div class="flex-none">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <span class="badge badge-sm indicator-item"><?php  echo count($_SESSION['cart'])  ?></span>
        </div>
      </label>
      <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
        <div class="card-body">
          <span class="font-bold text-lg"><?php  echo count($_SESSION['cart'])  ?> Items</span>
          <span class="text-info"></span>
          <div class="card-actions">
            <button class="btn btn-primary btn-block">  <a href="cart.php">View cart</a> </button>
          </div>
        </div>
      </div>
    </div>
    <?php 
      include "connect.php";
      include "./functions/userFunctions.php";
     
      
        
        if (!isset($_SESSION['login'])) {
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
               <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 mb-2 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
               <li>
          <a href = "Profiel.php?gebruikerid='.$userid.'" class="justify-between">
            Profiel
            <span class="badge">New</span>
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


  <div class="hero-image">
  <div class="hero-content text-center text-neutral-content">
    <div class="max-w-md">
      <h1 class="mt-14 text-5xl font-bold ">Hello there</h1>
      <p class="mt-14">Bekijk hier de beste horloges in het land.
      Voor een aantrekkelijke prijs.</p>
      
      <a href="productenBekijken.php"><button class="btn btn-primary mt-14">Shop now</button></a>
    </div>
  </div>
</div>


</body>
</html>
