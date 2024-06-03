<?php
include "connect.php";
include "functions/userFunctions.php";
session_start();

if(!isset($_SESSION['admin'])){
  header('location: index.php');
  return;
};

if (isset($_POST['submit'])) {
  $naam= $_POST['naam'];
  $prijs= $_POST['prijs'];
  $beschrijving= $_POST['beschrijving'];
  $categorie= $_POST['categorie'];
  $kleur = $_POST['kleur'];
  $upload_dir= $_SERVER['DOCUMENT_ROOT']."/Eindproject/public/img/";
  $file_name= $_FILES['file']['name'];
  $file_tmp= $_FILES['file']['tmp_name'];
   if (filesize($file_name) < 0) {
      echo "Error";
    }
    if(isset($file_name) && !empty($file_name)) {

      $teller = 1;
      while (file_exists($upload_dir . $file_name)) {
          $file_info = pathinfo($file_name);
          $new_file_name = $file_info['filename'] . $teller . "." . $file_info['extension'];
          $file_name = $new_file_name;
          $teller++;
      }
      move_uploaded_file($file_tmp, $upload_dir . $file_name);
  }
  if(addProduct($mysqli, $naam, $beschrijving, $prijs, $categorie, $kleur, $file_name, $verwijderd)){
    header('location: admin.php');

}else{
  echo "niet gelukt";
}
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Producten toevoegen</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
   <div class="navbar bg-base-100 ">
        <div class="flex-1">
            <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
        </div>
        <?php  

        if (!isset($_SESSION["login"])) {
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="/public/img/profile_picture">
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>';
        } else {
            $userid = $_SESSION["login"];
            $profielfoto = getProfilePicture($mysqli, $userid);
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="../public/img/'.$profielfoto.'"/>
                    </div>
                </label>  
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="gegevensBekijken.php">Klanten bekijken</a></li>
                    <li><a href="productToevoegen.php">Product Toevoegen</a></li>
                    <li><a href="betalingenAdmin.php">Bestellingen van klanten</a></li>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="verwijderdeK.php">Verwijderde klanten</a></li>
                    <li><a href="verwijderdeP.php">Verwijderde Producten</a></li>
                    <li><a href="loguit.php">Log uit</a></li>
                </ul>
            </div>';
        }
        ?>
    </div>
  <form action="productToevoegen.php" method="post" enctype="multipart/form-data" class="flex justify-center items-center p-4">
    <div class="card w-full max-w-lg shadow-2xl bg-white p-8">
      <h2 class="text-black text-2xl mb-4 text-center">Product toevoegen</h2>
      <div class="flex flex-col gap-4">
        <div>
          <label class="label">
            <span class="label-text">Foto</span>
          </label>
          <input type="file" name="file" class="file-input w-full max-w-md" accept="image/*" required />
        </div>
        <div>
          <label class="label">
            <span class="label-text">Naam</span>
          </label>
          <input type="text" name="naam" placeholder="Type here" class="input input-bordered w-full max-w-md" required />
        </div>
        <div>
          <label class="label">
            <span class="label-text">Prijs</span>
          </label>
          <input type="number" name="prijs" placeholder="Type here" class="input input-bordered w-full max-w-md" />
        </div>
        <div>
          <label class="label">
            <span class="label-text">Beschrijving</span>
          </label>
          <input type="text" name="beschrijving" placeholder="Type here" class="input input-bordered w-full max-w-md" />
        </div>
        <div class="form-control w-full max-w-md">
          <label class="label">
            <span class="label-text">Merk</span>
          </label>
          <select class="select select-bordered w-full" name="categorie">
            <option disabled selected>Kies een merk</option>
            <?php 
            if(getAllCategories($mysqli)){
              foreach(getAllCategories($mysqli) as $row) {
                echo "<option value='".$row["categorienaam"]."'>".$row["categorienaam"]."</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="form-control w-full max-w-md">
          <label class="label">
            <span class="label-text">Kleur</span>
          </label>
          <select class="select select-bordered w-full" name="kleur">
            <option disabled selected>Kies een kleur</option>
            <?php 
            foreach(getCategorieColor($mysqli) as $row) {
              echo "<option value='".$row["kleur"]."'>".$row["kleur"]."</option>";
            }
            ?>
          </select>
        </div>
        <div class="form-control w-full max-w-md">
          <button type="submit" name="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Toevoegen</button>
        </div>
      </div>
    </div>
  </form>
</body>
</html>
