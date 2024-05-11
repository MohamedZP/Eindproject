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

   function calculateTotalCart(){
    global $mysqli;
  $totalprijs = 0;
    $sql = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()) {
      $totalprijs += $row['prijs']*$row['aantal'];
    };

    $_SESSION['total'] = $totalprijs;
}

if (isset($_POST['edit_quantity'])) {
echo $_POST['quantity'];
  $sql6 = "UPDATE tblcart SET aantal ='".$_POST['quantity']."' WHERE productid = '".$_GET['productid']."'";
  if ($mysqli->query($sql6)) {

  } else {
    print("Aantal niet geupdate");
  };
 var_dump($sql6);
//calculate total
  calculateTotalCart();

}

     
 



if(isset($_POST['remove_product'])) {
//remove product
$sql7 = "DELETE FROM tblcart productid = '".$_GET['productid']."'";
//remove calculate total 
calculateTotalCart(); }




if (!isset($_POST['productid']) || !isset($_POST['quantity']) || !isset($_POST['price']) ) {
  if (isset($_SESSION['cart'])) {
    $sql2 = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."'";
    if ($mysqli->query($sql2)) {
      foreach($mysqli->query($sql2) as $db_row) {
        foreach($_SESSION['cart'] as $key => $value) {
          if ($db_row['productid'] == $value['productid']) {
            //echo "'".$db_row['productid']."' gevonden in de database." ;
          /*} else {
            echo "'".$value['productid']."' niet gevonden in de database";
          */};
        }
      };
    };
  } else {
    $totalprijs = 0;
    $sql3 = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."'";
    $result = $mysqli->query($sql3);
    while($row = $result->fetch_assoc()) {
      $totalprijs += $row['prijs']*$row['aantal'];
    };

    $_SESSION['total'] = $totalprijs;
  };
}


if (isset($_POST['add_to_cart'])) {
    $moettoevoegen = true;
    $sql4 = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."'";
    $result = $mysqli -> query($sql4);
    if (mysqli_num_rows($result) > 0) {
    
    while ($row = $result->fetch_assoc()) {
      if ($row['productid'] == $_POST['productid']) {
        echo "Product is er al";
        $moettoevoegen = false;
      }else{
        $moettoevoegen = true;
      }
    }
  } else {

   if ($moettoevoegen == true) {
         //if this is the first product
    $productid = $_POST['productid'];
    $naam = $_POST['name'];
    $prijs = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    $sql5 = "INSERT INTO tblcart (productid, gebruikerid, aantal, prijs ) VALUES ('".$_POST['productid']."','".$_SESSION['login']."','" .$_POST['quantity']."','".$_POST['price']."')";
    if ($mysqli -> query($sql5)) {
      echo "Succesvol toegevoegd";
    } else{
      var_dump($sql4);
    }    
  }
}
}

  
 



?>

<div class="navbar bg-base-100">
  <div class="flex-1">
    <a href="index.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
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

    
   $query = "SELECT * from tblcart where gebruikerid ='".$_SESSION['login']."'";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
      $miniquery = "SELECT * from tblproducten where productid ='".$row['productid']."'";
      $miniresult = $mysqli->query($miniquery);
      while($row2 = $miniresult->fetch_assoc()) {
        echo '
        <tr>
          <td>
            <div class="product-info">
              <img class="w-52 h-60 mb-2 mx-auto mt-4" src="../public/img/'.$row2['foto'].'" height = 200>
            <div>
            <p>'.$row2['naam'].'</p>
            <small><span>€</span> '.$row2['prijs'].'</small>
            <br>
            <form method="post" action="cart.php">
           <input type="hidden" name="productid" value="'.$row2['productid'].'"/>
           <button type="submit" class="edit-btn" name="edit_quantity" value="Delete"><a href="cart.php?productid='.$row2['productid'].'">Delete</a></button>
  
           </form>
          
          </div>
        </div>
          </td>
        
        <td>
          
          <form method="post" action="cart.php">
     <input type="number" name ="quantity" value="'.$row['aantal'].'" min = 1>
      <button type="submit" class="edit-btn" name="edit_quantity" value="Wijzigen"><a href="cart.php?productid='.$row['productid'].'">Wijzigen</a></button>
   </form>
          
        </td>
   
        <td>
          <span>€</span>
          <span class="product-price">'.$row2['prijs'] * $row['aantal'].'</span>
        </td>
        </tr>';
        };
      };
    
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
 <?php 

 echo '  <button class="btn checkout-btn" name="submit" onclick="openCheck('.$_SESSION['login'].')">Checkout</button>
';

  ?> 
</div>



  </section>
<script type="text/javascript">
  function openCheck(id) {
    window.location.href = "checkout.php?userid=" + id;
   window.alert(id);
  }
</script>
</body>
</html>