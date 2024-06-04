<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product Wijzigen</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
		  <?php
include "connect.php";

include "functions/userFunctions.php";
session_start();


if(!isset($_SESSION['admin'])){
  header('location: index.php');
  return;
};


if (isset($_POST['submit'])) {
    $productid =$_POST['productid'];
	 $naam= $_POST['naam'];
  	$prijs= $_POST['prijs'];
  	$beschrijving= $_POST['beschrijving'];
  	$categorie= $_POST['categorie'];
  	$kleur = $_POST['kleur'];
  	$upload_dir= $_SERVER['DOCUMENT_ROOT']."/Eindproject/public/img/";
  	$file_name= $_FILES['file']['name'];
  	$file_tmp= $_FILES['file']['tmp_name'];


  if (filesize( $file_name ) <= 0){
  echo "Error";
    }
    if (!(move_uploaded_file($file_tmp, $upload_dir . $file_name))) {
      echo "Error, kon de foto niet verplaatsen.";
    };
    modifyProduct2($mysqli, $naam, $productid ,$beschrijving, $prijs, $categorie);

    if(modifyProduct($mysqli, $naam, $productid ,$beschrijving, $prijs, $categorie, $file_name)){
    header('location: admin.php');
  
    }else{
	echo "Error product wijzigen.";
    }


}else{

 //Als er geen gekozenproduct is dan moet het naar admin.
  if (!isset($_GET['productid'])) {
    header("Location: admin.php");
  } else {
    $productid = $_GET['productid'];
    if(mysqli_num_rows(getProduct($mysqli, $productid)) == 0) {
      header("Location: admin.php");  
      //Als productID niet bestaat dan moet het naar admin.
    }
  }
 
  foreach(getProduct($mysqli, $productid) as $row) {


echo '<div>
    <div class="flex justify-start items-start">
      <a href="admin.php" class="btn btn-ghost normal-case text-xl text-black">MoWatch</a> 
    </div>
    <form class="form-control h-full flex items-center justify-center" action="wijzigen.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="productid" value="'.$productid.'"">
      <div class="card w-full max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4">Product Wijzigen</h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Product</label>
              <input type="text" name="naam" placeholder="Product" value = "'.$row["naam"].'" class="input input-bordered w-full max-w-md text-black bg-white" required  />
            </div>
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Minimale prijs</label>
              <input type="text" name="prijs" placeholder="Minimale prijs" value = "'.$row["prijs"].'" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Beschrijving</label>
              <textarea class="textarea textarea-bordered h-24  text-black bg-white" name="beschrijving" placeholder="Beschrijving"  required>'.$row["beschrijving"].'</textarea>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Productfoto</label>
              <input type="file" name="file" class="file-input file-input-bordered bg-white text-black" accept="image/*" value = "'.$row["foto"].'" />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black" >Merk</label>';
                $productCategorie = getProductCategorie($mysqli,$productid);
                print'<select class="select select-bordered bg-white text-black" name="categorie" required >';
                if($row["categorie"] == false ){
                  print' <option selected disabled>Kies een merk</option>';

                }

                foreach(getAllCategories($mysqli) as $row1){
                  if($row["categorie"] == $row1["categorienaam"]){
                    print' <option disabled>Kies een merk</option>
                    <option selected value="'.$row1["categorienaam"].'">'.$row1["categorienaam"].'</option>';
                  }else{
                    print'<option value="'.$row1["categorienaam"].'">'.$row1["categorienaam"].'</option>';
                  }
                
                }
                print'</select>';
             }
           
          }
              ?>
              </select>
            </div>
          </div>
          <button type="submit" name ="submit"class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Wijzigen</button>
        
      
        </div>
      </div>
    </form>
  </div>

</body>
</html>
