<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Betalingen</title>
</head>
<body>
  <div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>

  
  <div class="flex-none">
    
    <?php 
      include "connect.php";
      include "./functions/userFunctions.php";
     session_start();
        
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
          <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href= "gegevensBekijken.php">Klanten bekijken</a></li>
        <li><a href= "productToevoegen.php">Product Toevoegen</a></li>
         <li>
          <a href = "BetalingenAdmin.php" class="justify-between">
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
$query = "SELECT * from tblaankoop ORDER BY gebruikerid ";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
      $miniquery = "SELECT * from tblproducten where productid ='".$row['productid']."'";
      $miniresult = $mysqli->query($miniquery);
      while($row2 = $miniresult->fetch_assoc()) {
      $minisql = "SELECT * from tblgebruikers where gebruikerid ='".$row['gebruikerid']."'";
      $miniresultaat = $mysqli->query($minisql);
      while($row3 = $miniresultaat->fetch_assoc()) {
            echo '

        <div class="py-14 px-4 md:px-6 2xl:px-20 2xl:container 2xl:mx-auto">
            <div class="flex justify-start item-start space-y-2 flex-col">
                <h1 class="text-3xl dark:text-white lg:text-4xl font-semibold leading-7 lg:leading-9 text-gray-800">Order '.$row['aankoopid'].'</h1>
                <p class="text-base dark:text-gray-300 font-medium leading-6 text-gray-600">'.$row['datum'].'</p>
            </div> 
            <div class="mt-10 flex flex-col xl:flex-row jusitfy-center items-stretch w-full xl:space-x-8 space-y-4 md:space-y-6 xl:space-y-0">
                <div class="flex flex-col justify-start items-start w-full space-y-4 md:space-y-6 xl:space-y-8">
                    <div class="flex flex-col justify-start items-start dark:bg-gray-800 bg-gray-50 px-4 py-4 md:py-6 md:p-6 xl:p-8 w-full">
                        <p class="text-lg md:text-xl dark:text-white font-semibold leading-6 xl:leading-5 text-gray-800">Customer’s Cart</p>
                        <div class="mt-4 md:mt-6 flex flex-col md:flex-row justify-start items-start md:items-center md:space-x-6 xl:space-x-8 w-full">
                            <div class="pb-4 md:pb-8 w-full md:w-40">
                                <img class="w-full hidden md:block" src="../public/img/'.$row2['foto'].'" />
                            </div>
                            <div class="border-b border-gray-200 md:flex-row flex-col flex justify-between items-start w-full pb-8 space-y-4 md:space-y-0">
                                <div class="w-full flex flex-col justify-start items-start space-y-8">
                                    <h3 class="text-xl dark:text-white xl:text-2xl font-semibold leading-6 text-gray-800">'.$row2['naam'].'</h3>
                                    <div class="flex justify-start items-start flex-col space-y-2">
                                        <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Brand: </span> '.$row2['categorie'].'</p>
                                        <p class="text-sm dark:text-white leading-none text-gray-800"></p>
                                        <p class="text-sm dark:text-white leading-none text-gray-800"><span class="dark:text-gray-400 text-gray-300">Color: </span> '.$row2['kleur'].'</p>
                                    </div>
                                </div>
                                <div class="flex justify-between space-x-8 items-start w-full">
                                    <p class="text-base dark:text-white xl:text-lg leading-6">€'.$row['prijs'].' <span class="text-red-300 line-through"> </span></p>
                                    <p class="text-base dark:text-white xl:text-lg leading-6 text-gray-800">'.$row['quantity'].'</p>
                                    <p class="text-base dark:text-white xl:text-lg font-semibold leading-6 text-gray-800">€'.$row['totaal'].'</p>
                                </div>
                            </div>
                        </div>
                <div class="bg-gray-50 dark:bg-gray-800 w-full xl:w-96 flex justify-between items-center md:items-start px-4 py-6 md:p-6 xl:p-8 flex-col">
                    <h3 class="text-xl dark:text-white font-semibold leading-5 text-gray-800">Customer'.$row['gebruikerid'].'</h3>
                    <div class="flex flex-col md:flex-row xl:flex-col justify-start items-stretch h-full w-full md:space-x-6 lg:space-x-8 xl:space-x-0">
                        <div class="flex flex-col justify-start items-start flex-shrink-0">
                            <div class="flex justify-center w-full md:justify-start items-center space-x-4 py-8 border-b border-gray-200  w-full">
                                <img class=" hidden md:block" src="../public/img/'.$row3['profielfoto'].'" alt="avatar" height = "100" width = "100" />
                                <div class="flex justify-start items-start flex-col space-y-6">
                                    <p class="text-base dark:text-white font-semibold leading-4 text-left text-gray-800">'.$row3['voornaam'].'  '.$row3['naam'].'</p>
                                    
                                </div>
                            </div>
    
                            <div class="flex justify-center text-gray-800 dark:text-white md:justify-start items-center space-x-4 py-4 border-b border-gray-200 w-full">
                                <img class="dark:hidden" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1.svg" alt="email">
                                <img class="hidden dark:block" src="https://tuk-cdn.s3.amazonaws.com/can-uploader/order-summary-3-svg1dark.svg" alt="email">
                                <p class="cursor-pointer text-sm leading-5 ">'.$row3['email'].'</p>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
}
}
}
?>
</body>
</html>