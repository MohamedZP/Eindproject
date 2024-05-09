<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css"/>
	<title></title>
</head>
<body>

<?php  
session_start();
include 'connect.php';


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
echo $prodnaam;
echo $profoto;
echo $prijs;
echo $proid;
echo $hoeveelheid;


?>
<div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
    <h1 class="font-bold text-2xl my-4 text-center text-blue-600">MoWatch</h1>
    <hr class="mb-2">
    <div class="flex justify-between mb-6">
        <h1 class="text-lg font-bold">Invoice</h1>
        <div class="text-gray-700">
            <div>Date: 01/05/2023</div>
            <div>Invoice #: INV12345</div>
        </div>
    </div>
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-4">Bill To:</h2>
        <div class="text-gray-700 mb-2">John Doe</div>
        <div class="text-gray-700 mb-2">123 Main St.</div>
        <div class="text-gray-700 mb-2">Anytown, USA 12345</div>
        <div class="text-gray-700">johndoe@example.com</div>
    </div>
    <table class="w-full mb-8">
        <thead>
            <tr>
                <th class="text-left font-bold text-gray-700">Product</th>
                <th class="text-center font-bold text-gray-700">Quantity</th>
                <th class="text-right font-bold text-gray-700">Amount</th>
            </tr>
        </thead>
        <tbody>
        	
           	 <tr>
                <td class="text-left text-gray-700">Product 1</td>
                <td class="text-center text-gray-700">Product 1</td>
                <td class="text-right text-gray-700">$100.00</td>
            </tr>
         
           
            <tr>
                <td class="text-left text-gray-700">Product 2</td>
                <td class="text-center text-gray-700">Product 1</td>
                <td class="text-right text-gray-700">$50.00</td>
            </tr>
            <tr>
                <td class="text-left text-gray-700">Product 3</td>
                <td class="text-center text-gray-700">Product 1</td>
                <td class="text-right text-gray-700">$75.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td class="text-left font-bold text-gray-700">Total</td>
                <td class="text-center font-bold text-gray-700">	</td>
                <td class="text-right font-bold text-gray-700">$225.00</td>
            </tr>
        </tfoot>
    </table>
    <div class="text-gray-700 mb-2">Thank you for your business!</div>
    <div class="text-gray-700 text-sm">Please remit payment within 30 days.</div>
</div>
</body>
</html>