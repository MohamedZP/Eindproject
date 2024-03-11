<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
  <link rel="stylesheet"  href="style.css">
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
	<?php
	 include "connect.php";
      
     
  session_start();
	if(!isset($_SESSION['login'])){
  header('location: index.php');
  return;
};

   /*$sql = "INSERT INTO tblcart (productid, gebruikerid, aantal ) VALUES ('".$_POST['productid']."','".$_SESSION['login']."','" .$_POST['quantity']."')";
  if ($mysqli -> query($sql)) {
    echo "Succesvol toegevoegd";
  }else{
    echo "error";
  }*/
if (isset($_POST['add_to_cart'])) {
  if (isset($_SESSION['cart'])) {
    //if user has already something in cart
    $products_array_ids = array_column($_SESSION['cart'], "productid");
    if (!in_array($_POST['productid'], $products_array_ids)) {
      // Is deze product al toegevoegd in de cart of niet.
       $productid = $_POST['productid']; 

      $product_array = array(
      'productid' => $_POST['productid'],
      'name' => $_POST['name'],
      'price' => $_POST['price'],
      'image' => $_POST['image'],
      'quantity' => $_POST['quantity']  
    );
    $_SESSION['cart'][$_POST['productid']] = $product_array;
    }else{

      //product is al toegevoegd in de cart
      echo "<script>alert('Product is al toegevoegd');</script>";
      

    }

 
  }else{
     //if this is the first product
    $productid = $_POST['productid'];
    $naam = $_POST['name'];
    $prijs = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    $product_array = array(
      'productid' => $productid,
      'name' => $naam,
      'price' => $prijs,
      'image' => $image,
      'quantity' => $quantity
      //array om alle data te verzamelen  
 
    );

 
    $_SESSION['cart'][$productid] = $product_array;
    // elke array die zal worden toegevoegd aan de cart moet uniek zijn dus daarom wordt het gekoppeld aan de productid bv [2=>[] , 3=>[]]
  }

  //calculate total
  calculateTotalCart();
  
  
}elseif (isset($_POST['remove_product'])) {
//remove product
  $productid = $_POST['productid'];
  unset($_SESSION['cart'][$productid]);

//remove calculate total 
calculateTotalCart(); 

}elseif (isset($_POST['edit_quantity'])) {
  // wijzigen van aantal, we nemen id en quantity van de form
  $productid = $_POST['productid'];
  $quantity = $_POST['quantity'];

  // get the product array from the session
  $product_array = $_SESSION['cart'][$productid];
  //update product quantity
  $product_array['quantity'] = $quantity;

  //return array back its place
  $_SESSION['cart'][$productid] = $product_array;

  // edit calculate total
  calculateTotalCart();



}


function calculateTotalCart(){
  $total = 0;

  foreach($_SESSION['cart'] as $key => $value){
    $product =  $_SESSION['cart'][$key];

    $price = $product['price'];
    $quantity = $product['quantity'];
    $total = $total + ($price * $quantity);


  }
  $_SESSION['total'] = $total;
}



?>

<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
  </div>

  <div class="form-control">
      <input type="text" placeholder="Search" class="input input-bordered w-24 md:w-auto" />
    </div>
  <div class="flex-none">
    
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


	<section class="cart container my-5 py-5">
   <div class="container mt-5">
     <h2 class="font-weight-bolde">Your Cart</h2>
     <hr>
   </div>
   <table class="mt-5 pt-5">
     <tr>
       <th>Product</th>
       <th>Aantal</th>
       <th>Subtotaal</th>
     </tr>


    <?php 
   foreach ($_SESSION['cart'] as $key =>$value)  {
     // code...
   
echo '
     <tr>
       <td>
         <div class="product-info">
           <img class="w-52 h-60 mb-2 mx-auto mt-4" src="../public/img/'.$value['image'].'" height = 200>
         <div>
         <p>'.$value['name'].'</p>
         <small><span>€</span> '.$value['price'].'</small>
         <br>
         <form method="post" action="cart.php">
        <input type="hidden" name="productid" value="'.$value['productid'].'"/>
        <input type="submit" name="remove_product" class="remove-btn" value="Verwijderen"/>
        </form>
       
       </div>
     </div>
       </td>
     
     <td>
       
       <form method="post" action="cart.php">
  <input type="hidden" name="productid" value="'.$value['productid'].'">
  <input type="number" name ="quantity" value="'.$value['quantity'].'" min = 1>
  <input type="submit" name="edit_quantity" class="edit-btn" value="Wijzigen"/>
</form>
       
     </td>

     <td>
       <span>€</span>
       <span class="product-price">'.$value['price'] * $value['quantity'].'</span>
     </td>
     </tr>';
     }
    ?>
   </table>

<div class="cart-total">
  <table>
    <tr>
      <td>Total</td>
      <td>€<?php echo $_SESSION['total'] ; ?></td>
    </tr>
  </table>
</div>

<div class="checkout-container">
  <button class="btn checkout-btn">Checkout</button>
</div>



  </section>

</body>
</html>