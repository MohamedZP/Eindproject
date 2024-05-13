<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
     $totalprijs = 0;

function calculateTotal($prijs) {
    global $mysqli;
    $sql = "SELECT * from tblaankoop where gebruikerid = '".$_SESSION['login']."' AND datum = '".$_SESSION['datum']."'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()) {
      $prijs += $row['prijs']*$row['quantity'];
    };
    return $prijs;

};
      
   
        
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
          <a href = "Betalingenadmin.php class="justify-between">
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


</body>
</html>