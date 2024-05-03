<?php
include 'include.php';
include 'connect.php';
session_start();

$userid = $_SESSION['login'];
$id = $_GET['id'];

$sql = "SELECT * FROM tblproducten WHERE gebruikerid = $id";
$result = $mysqli->query($sql);

if ($result === FALSE) {
    die("Error executing query: " . $mysqli->error);
}

$row = $result->fetch_assoc();
foreach ($_SESSION['cart'] as $key =>$value)  {
$prodnaam = $value["name"];
$profoto = $value["image"];
$prijs = $value["price"];
$proid = $value["productid"];
$hoeveelheid = $value["quantity"];
}
$stripe_key = "sk_test_51P80uoIbeVkRBGzB3qPy7C387wkARiTmcsJ6FQWqIIrPbedgr2Glri0B2GX7fsxp9R9JzLcyQUGR25z6CMS8bbbn00snOmRvXg";
\Stripe\Stripe::setApiKey($stripe_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://http://mo/src/succes.php?session_id={CHECKOUT_SESSION_ID}",
    "cancel_url" => "http://mo/src/Cart.php",
    "billing_address_collection" => "required",
    "allow_promotion_codes" => true,
    "line_items" => [
        [
            "quantity" => $hoeveelheid,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => $prijs,
                "product_data" => [
                    "name" => $prodnaam,
                    "description" => $row["beschrijving"],
                    "images" => $row["foto"]
                ]
            ]
        ]
    ],
    "metadata" => [
        "product_id" => $row['productid']  
    ]
]);

header("Location: " . $checkout_session->url);
exit;
?>