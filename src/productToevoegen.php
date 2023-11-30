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
	  <?php
include "connect.php";
include "functions/userFunctions.php";
session_start();

if(!isset($_SESSION['login'])){
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
  if((empty($_POST['file']))){
    move_uploaded_file($file_tmp,$upload_dir.$file_name);
  }
  if(addProduct($mysqli, $naam, $beschrijving, $prijs, $categorie,$kleur ,$file_name)){
    header('location: admin.php');

}else{
	echo "niet gelukt";
}
}

  ?>
    <div class="flex justify-start items-start">
      <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a> 
    </div>
    <form action="productToevoegen.php" method="post" enctype= "multipart/form-data">

    <div class="card w-1/3 max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4 ">Product toevoegen</h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
  
    <label class="label">
    <span class="label-text" >Foto</span>
    </label>
  <input type="file" name = "file" class="file-input w-full max-w-md" required />
  </label>
    <label class="label">
    <span class="label-text " >Naam</span>
    </label>
  <input type="text" name = "naam" placeholder="Type here" class="input input-bordered w-full max-w-md" required />
  </label>
    <label class="label">
    <span class="label-text " >Prijs</span>
    </label>
  <input type="number" name = "prijs" placeholder="Type here" class="input input-bordered w-full max-w-md" />
  </label>
    <label class="label">
    <span class="label-text " >Beschrijving</span>
    </label>
  <input type="text" name = "beschrijving" placeholder="Type here" class="input input-bordered w-full max-w-md" />
  </label>
<div class="form-control w-full max-w-md">
  <label class="label">
    <span class="label-text " >Merk</span>
  </label>
 <?php 
  if(getAllCategories($mysqli)){
    echo "
  <select class='select select-bordered' name='categorie'>
   <option disabled selected>kies een merk</option>";
 
      foreach(getAllCategories($mysqli) as $row) {

echo " <option value= ".$row["categorienaam"]. " >".$row["categorienaam"]." </option>
		
  ";

}
}
  ?>
  </select>
</div>
<div class="form-control w-full max-w-md">
  <label class="label">
    <span class="label-text">Kleur</span>
  </label>
 <?php 
 
    echo "
  <select class='select select-bordered mb-3' name='kleur'>
   <option disabled selected>kies een kleur</option>";
 
      foreach(getCategorieColor($mysqli) as $row) {

echo " <option value= ".$row["kleur"]. " >".$row["kleur"]." </option>
		
  ";

}

  ?>
  </select>
</div>
<div class="form-control w-full max-w-md">
  <label class="label">
   
  </label>
  <button type="submit" name ="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Toevoegen</button>
  
  
</div>


</div>
</form>


</body>
</html>