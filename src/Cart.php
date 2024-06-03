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

if (isset($_POST['edit_quantity']) AND isset($_POST['quantity']) AND isset($_POST['edit_productid'])) {
    $sql6 = "UPDATE tblcart SET aantal = '".$_POST['quantity']."' WHERE productid = '".$_POST['edit_productid']."' AND gebruikerid = '".$_GET['gebruikerid']."'";
    if ($mysqli->query($sql6)) {
      echo "<script>alert('Product is geupdate');</script>";
    } else {
      echo "<script>alert('Product is niet geupdate');</script>";
    };
   
  //calculate total
    calculateTotalCart();
};
 
if(isset($_POST['product']) AND isset($_POST['productid'])) {
//remove product
$sql7 = "DELETE FROM tblcart WHERE productid = '".$_POST['productid']."' AND gebruikerid = '".$_GET['gebruikerid']."'";
if ($mysqli->query($sql7)) {
  echo "<script>alert('Product is verwijderd');</script>";
} else {
  echo "<script>alert('Product is niet verwijderd');</script>";
};

//remove calculate total 
calculateTotalCart(); 
};



if (!isset($_POST['productid']) || !isset($_POST['quantity']) || !isset($_POST['price']) ) {
  $totalprijs = 0;
  $sql3 = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."'";
  $result = $mysqli->query($sql3);
  while($row = $result->fetch_assoc()) {
    $totalprijs += $row['prijs']*$row['aantal'];
  };
  $_SESSION['total'] = $totalprijs;
};


if (isset($_POST['add_to_cart'])) {
    $moettoevoegen = true;
    $sql4 = "SELECT * from tblcart where gebruikerid = '".$_SESSION['login']."' AND productid = '".$_POST['productid']."'";
    $result = $mysqli -> query($sql4);
    if (mysqli_num_rows($result) > 0) {
    
    while ($row = $result->fetch_assoc()) {
      if ($row['productid'] == $_POST['productid']) {
        echo "<script>alert('Product is al in de cart');</script>";
        $moettoevoegen = false;
      }else{
        $moettoevoegen = true;
      }
    }
  }
    
if (mysqli_num_rows($result) <= 0) {
   if ($moettoevoegen == true) {
         //if this is the first product
    $productid = $_POST['productid'];
    $naam = $_POST['name'];
    $prijs = $_POST['price'];
    $image = $_POST['image'];
    $quantity = $_POST['quantity'];

    $sql5 = "INSERT INTO tblcart (productid, gebruikerid, aantal, prijs ) VALUES ('".$_POST['productid']."','".$_SESSION['login']."','" .$_POST['quantity']."','".$_POST['price']."')";
    if ($mysqli -> query($sql5)) {
      echo "<script>alert('Product is toegevoegd');</script>";
    } else{
      echo "<script>alert('Product is niet toegevoegd');</script>";
    }
  } 
  calculateTotalCart();    
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
          <img src="/public/img/profile_picture.jpg">
        </div>
      </label>
             <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="login.php">Login</a><li>
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
          <a href = "profiel.php" class="justify-between">
            Profiel
            
          </a>
        </li>
        <li>
          <a href = "betalingen.php" class="justify-between">
            Betalingen
          </a>
        </li>
        <li><a href="loguit.php">Log uit</a></li>
      </ul>

  ';
}


?>
        </div>
  </div>
</div>


  <section class="cart container my-5 py-5 ml-12 pr-16">
   <div class="container mt-5">
     <h2 class="font-weight-bolde">Uw winkelwagen</h2>
     <hr>
   </div>
   <table class="mt-5 pt-5">
     <tr>
       <th>Product</th>
       <th>Aantal</th>
       <th>Subtotaal</th>
     </tr>


    <?php 

    
   $query = "SELECT * from tblcart where gebruikerid ='".$_SESSION['login']."' ORDER BY productid";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc()) {
      $miniquery = "SELECT * from tblproducten where productid ='".$row['productid']."'";
      $miniresult = $mysqli->query($miniquery);
      while($row2 = $miniresult->fetch_assoc()) {
        echo '
        <tr>
          <td>
            <div class="product-info">
              <img class="w-52 h-60 mb-2 mx-auto mt-4 ml-1" src="../public/img/'.$row2['foto'].'" height = 200>
            <div class = " ml-1">
            <p >'.$row2['naam'].'</p>
            <small><span>€</span> '.$row2['prijs'].'</small>
            <br>
             <br>
            <form method="post" action="cart.php?gebruikerid='.$row['gebruikerid'].'">
           <input type="hidden" name="productid" value="'.$row2['productid'].'"/>
           <input type="submit" class="remove-btn" name="product" value="Verwijderen"></input>
  
           </form>
           
          
          </div>
        </div>
          </td>
        
        <td>
         <br>
          <form method="post" action="cart.php?gebruikerid='.$row['gebruikerid'].'">
          <input type="hidden" name="edit_productid" value="'.$row2['productid'].'"/>
          <input type="number" name ="quantity" value="'.$row['aantal'].'" min = 1>
      <input type="submit" class="edit-btn pt-5" name="edit_quantity" value="Wijzigen"></input>
   </form>
          
          
        </td>
   
        <td>
          <span>€</span>
          <span class="product-price">'.$row2['prijs'] * $row['aantal'].'</span>
        </td>
        </tr>
           
           ';
      };
      };


        
    
    ?>
    </table>
<div class="cart-total">
  <table>
    <tr>
      <td>Totaal</td>
      <td>€<?php echo $_SESSION['total'] ; ?></td>
    </tr>
  </table>
</div>


<div class="checkout-container">
 <?php 

if (!empty($_SESSION['total']) ) {
       echo '  <button class="btn checkout-btn " name="submit" onclick="openCheck('.$_SESSION['login'].')">Checkout</button>
';   
 }

  ?> 
</div>



  </section>
<script type="text/javascript">
  function openCheck(id) {
    window.location.href = "checkout.php?userid=" + id;
  // window.alert(id);
  }
</script>
</body>
</html>