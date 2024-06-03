<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
</head>
<body class="bg-gray-100">
    <div class="navbar bg-base-100 ">
        <div class="flex-1">
            <a href="admin.php" class="btn btn-ghost normal-case text-xl">MoWatch</a>
        </div>
        <?php   
        include "connect.php";
        include "./functions/userFunctions.php";

        session_start();
        if(!isset($_SESSION["admin"])){
            header('location: index.php');
            return;
        };

        if (!isset($_SESSION["login"])) {
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="/Eindproject/public/img/profile_picture">
                    </div>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="Login.php">Login</a></li>
                </ul>
            </div>';
        } else {
            $userid = $_SESSION["login"];
            $profielfoto = getProfilePicture($mysqli, $userid);
            echo '
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="../public/img/'.$profielfoto.'"/>
                    </div>
                </label>  
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="gegevensBekijken.php">Klanten bekijken</a></li>
                    <li><a href="productToevoegen.php">Product Toevoegen</a></li>
                    <li><a href="BetalingenAdmin.php">Bestellingen van klanten</a></li>
                    <li><a href="Dashboard.php">Dashboard</a></li>
                    <li><a href="verwijderdeK.php">Verwijderde klanten</a></li>
                    <li><a href="verwijderdeP.php">Verwijderde Producten</a></li>
                    <li><a href="Loguit.php">Log uit</a></li>
                </ul>
            </div>';
        }
        ?>
    </div>
     <div class="container mx-auto my-8 grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
        <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Totaalbedrag</h2>
                <div class="text-center">
                    <?php 
                    // SQL query om het totaalbedrag op te halen
                    $sql = "SELECT SUM(totaal) AS total_amount FROM tblaankoop";

                    // Voer de query uit
                    $result = $mysqli->query($sql);

                    // Controleer of de query succesvol was
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $total_amount = $row['total_amount'];
                        echo "<p class='text-lg font-bold'>€" . number_format($total_amount, 2) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van het totaalbedrag: " . $mysqli->error . "</p>";
                    } 
                    ?>
                </div>
            </div>
        </div>
        <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Aantal Gebruikers</h2>
                <div class="text-center">
                    <?php 
                    $sql2 = "SELECT COUNT(naam) AS total_user FROM tblgebruikers WHERE Verwijderd = 0";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql2);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $total_user = $row['total_user'];
                        echo "<p class='text-lg font-bold'>" . number_format($total_user, 0) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van aantal gebruikers: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Aantal Producten</h2>
                <div class="text-center">
                    <?php 
                    $sql3 = "SELECT COUNT(naam) AS total_products FROM tblproducten WHERE Verwijderd = 0";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql3);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $total_products = $row['total_products'];
                        echo "<p class='text-lg font-bold'>" . number_format($total_products, 0) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van aantal producten: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
                <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Aantal Verwijderde Gebruikers</h2>
                <div class="text-center">
                    <?php 
                    $sql4 = "SELECT COUNT(naam) AS total_D_user FROM tblgebruikers WHERE Verwijderd = 1";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql4);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $total_D_user = $row['total_D_user'];
                        echo "<p class='text-lg font-bold'>" . number_format($total_D_user, 0) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van aantal verwijderde gebruikers: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Aantal Verwijderde Producten</h2>
                <div class="text-center">
                    <?php 
                    $sql5 = "SELECT COUNT(naam) AS total_D_products FROM tblproducten WHERE Verwijderd = 1";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql5);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $total_D_products = $row['total_D_products'];
                        echo "<p class='text-lg font-bold'>" . number_format($total_D_products, 0) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van aantal verwijderde producten: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
          <div class="card bg-white shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-center">Aantal Verkochte Producten</h2>
                <div class="text-center">
                    <?php 
                    $sql6 = "SELECT COUNT(productid) AS total_V_products FROM tblaankoop ";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql6);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $total_V_products = $row['total_V_products'];
                        echo "<p class='text-lg font-bold'>" . number_format($total_V_products, 0) . "</p>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van aantal verkochte producten: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card bg-white shadow-xl col-span-2">
            <div class="card-body">
                <h2 class="card-title text-center">Meest Verkochte Product</h2>
                <div class="flex justify-center items-center space-x-4">
                    <?php 
                    $sql7 = "SELECT product.naam, product.prijs, product.foto, COUNT(aankoop.productid) AS count 
                             FROM tblaankoop aankoop 
                             JOIN tblproducten product ON aankoop.productid = product.productid 
                             GROUP BY aankoop.productid 
                             ORDER BY count DESC 
                             LIMIT 1";

                    // Voer de query uit
                    $resultaat = $mysqli->query($sql7);

                    // Controleer of de query succesvol was
                    if ($resultaat) {
                        $row = $resultaat->fetch_assoc();
                        $product_price = $row['prijs'];
                        $product_count = $row['count'];
                        
                        echo "<img src='../public/img/" . $row['foto'] . "' alt='" . $row['naam'] . "' class='w-52 h-52 object-cover '>";
                        echo "<div>";
                        echo "<p class='text-lg font-bold'>Naam: " . $row['naam'] . "</p>";
                        echo "<p class='text-lg'>Prijs: €" . number_format($product_price, 2) . "</p>";
                        echo "<p class='text-lg'>Aantal Verkocht: " . number_format($product_count, 0) . "</p>";
                        echo "</div>";
                    } else {
                        echo "<p class='text-red-500'>Fout bij het ophalen van meest verkochte product: " . $mysqli->error . "</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>