<?php

include "include.php";

include "connect.php";

session_start();



//$userid = $_SESSION["login"];

$id = $_GET["userid"];



$sql = "SELECT * FROM tblcart WHERE gebruikerid = $id";

$result = $mysqli->query($sql);



if ($result === false) {

    die("Error executing query: " . $mysqli->error);

}



$row = $result->fetch_assoc();



$items = [];

  $query = "SELECT * from tblcart where gebruikerid ='".$id."'";

    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {

      $miniquery = "SELECT * from tblproducten where productid ='".$row['productid']."'";

      $miniresult = $mysqli->query($miniquery);

      while($row2 = $miniresult->fetch_assoc()) {

    

    $prodnaam = $row2["naam"];

    $profoto = $row2["foto"];

    $prijs = $row2["prijs"];

    $proid = $row["productid"];

    $hoeveelheid = $row["aantal"];



    $items[] = [

        "quantity" => $hoeveelheid,

        "price_data" => [

            "currency" => "eur",

            "unit_amount" => $prijs * 100,

            "product_data" => [

                "name" => $prodnaam,

            ],

        ],

    ];

}

}

  




$stripe_key =

    "sk_test_51P80uoIbeVkRBGzB3qPy7C387wkARiTmcsJ6FQWqIIrPbedgr2Glri0B2GX7fsxp9R9JzLcyQUGR25z6CMS8bbbn00snOmRvXg";

\Stripe\Stripe::setApiKey($stripe_key);



$checkout_session = \Stripe\Checkout\Session::create([

    "mode" => "payment",

    "success_url" =>

        "http://mohamed/Eindproject/src/succes.php?session_id={CHECKOUT_SESSION_ID}&userid={$id}",

    "cancel_url" => "http://mohamed/Eindproject/src/cart.php",

    "billing_address_collection" => "required",

    "allow_promotion_codes" => true,

    "line_items" => $items  ,

    "metadata" => [

        "product_id" => $id,

    ],

]);



header("Location: " . $checkout_session->url);

exit();

?>
