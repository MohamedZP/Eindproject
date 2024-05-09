 <?php
include "include.php";
include "connect.php";
session_start();

$userid = $_SESSION["login"];
$id = $_GET["id"];

$sql = "SELECT * FROM tblproducten WHERE productid = $id";
$result = $mysqli->query($sql);

if ($result === false) {
    die("Error executing query: " . $mysqli->error);
}

$row = $result->fetch_assoc();


$items = [];
foreach ($_SESSION["cart"] as $key => $value) {
    $prodnaam = $value["name"];
    $profoto = $value["image"];
    $prijs = $value["price"];
    $proid = $value["productid"];
    $hoeveelheid = $value["quantity"];

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
  


$stripe_key =
    "sk_test_51P80uoIbeVkRBGzB3qPy7C387wkARiTmcsJ6FQWqIIrPbedgr2Glri0B2GX7fsxp9R9JzLcyQUGR25z6CMS8bbbn00snOmRvXg";
\Stripe\Stripe::setApiKey($stripe_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" =>
        "http://mohamed/Eindproject/src/succes.php?session_id={CHECKOUT_SESSION_ID}",
    "cancel_url" => "http://mohamed/Eindproject/src/Cart.php",
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
<<!-- ?php 
session_start();
foreach (
$_SESSION['cart'] as $key =>$value)  {
$profoto = $value["image"];
$prodnaam = $value["name"];
$prijs = $value["price"];
$proid = $value["productid"];
$hoeveelheid = $value["quantity"];
}
echo $prodnaam;
echo $profoto;
echo $prijs;
echo $proid;
echo $hoeveelheid;


 ?> -->
