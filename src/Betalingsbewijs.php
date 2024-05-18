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

$totalprijs = 0;

function calculateTotal($prijs) {
    global $mysqli;
    $sql = "SELECT * from tblaankoop where gebruikerid = '".$_SESSION['login']."' AND datum = '".$_SESSION['datum']."'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_assoc()) {
      $prijs += $row['prijs']*$row['quantity'];
    };
    return $prijs;
};

echo '<div class="bg-white border rounded-lg shadow-lg px-6 py-8 max-w-md mx-auto mt-8">
    <h1 class="font-bold text-2xl my-4 text-center text-blue-600">MoWatch</h1>
    <hr class="mb-2">
    <div class="flex justify-between mb-6">
        <h1 class="text-lg font-bold">Factuur</h1>
        <div class="text-gray-700">
            <div>Datum: '.date("Y-m-d H:i:s").'</div>
            <div>Factuur : INV12345</div>
        </div>
    </div>
    <div class="mb-8">
        <h2 class="text-lg font-bold mb-4">Factuur aan:</h2>
        ';
        $sql2 = "SELECT * FROM tblgebruikers where gebruikerid = '".$_SESSION['login']."'";
        $result2 = $mysqli->query($sql2);
        while($row2 = $result2->fetch_assoc()) {
        echo'
        <div class="text-gray-700 mb-2">De '.$row2["voornaam"].'  '.$row2["naam"].'</div>
        <div class="text-gray-700 mb-2">123 Main St.</div>
        <div class="text-gray-700 mb-2">Anytown, USA 12345</div>
        <div class="text-gray-700">'.$row2["email"].'</div>
    </div>';
}
echo'
    <table class="w-full mb-8">
        <thead>
            <tr>
                <th class="text-left font-bold text-gray-700">Product</th>
                <th class="text-center font-bold text-gray-700">Aantal</th>
                <th class="text-right font-bold text-gray-700">Prijs</th>
            </tr>
        </thead>
        <tbody>
            ';
        $query = "SELECT * FROM tblaankoop where gebruikerid = '".$_GET['userid']."' AND datum = '".$_SESSION['datum']."'";
        $result = $mysqli->query($query);
        while($row = $result->fetch_assoc()) {
            echo '<tr>
                <td class="text-left text-gray-700 pt-2">'.$row['productnaam'].'</td>
                <td class="text-center text-gray-700 pt-2"> '.$row['quantity'].'</td>
                <td class="text-right text-gray-700 pt-2">'.$row['totaal'].'</td>
            </tr>';
        };

        echo '
        </tbody>

        <tfoot>

            <tr>
                <td class="text-left font-bold text-gray-700 pt-8">Totaal</td>
                <td class="text-center font-bold text-gray-700 pt-8">    </td>
                <td class="text-right font-bold text-gray-700 pt-8">'.calculateTotal($totalprijs).'</td>
            </tr>
        </tfoot>
    </table>
    <br>    
    <div class="text-gray-700 mb-2">Bedankt voor uw aankoop!</div>
    
</div>
<div class="grid h-20 flex-grow card rounded-box place-items-center mx-12">
 <a href="index.php" class="px-12 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold rounded-box py-3">Ga naar de hoofdpagina</a>
 </div>
</body>
</html>';

?>
