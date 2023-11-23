<?php  

function addProduct($connection,$naam, $beschrijving, $prijs, $categorie,$kleur ,$foto){
    return($connection ->query("INSERT INTO tblproducten (naam, beschrijving, prijs, categorie,kleur, foto ) VALUES ('".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','".$kleur."','" .$foto."')"));
}

function modifyProduct($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie, $foto){
    if(empty($foto)) {
        if(getProduct($connection,$productID)){
            $foto = getProductPicture($connection,$productID);
        }else{
            print $connection->error;
        }
    }
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."', foto = '" .$foto."' WHERE productid = '".$productID."'") ) ;

}

function modifyProduct2($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie){
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."' WHERE productid = '".$productID."'") ) ;

}

function getProduct($connection,$productID){
    return $connection->query("SELECT * FROM tblproducten WHERE productid = '".$productID."'");
}
function getProductCategorie($connection, $productID){  
    $resultaat = $connection->query("SELECT categorie FROM tblproducten where productid= '".$productID."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['categorie'];
}
function getProductPicture($connection,$productID) {
    return getProduct($connection,$productID)->fetch_assoc()['foto'];
}

function getSeller($connection, $sellerID) {
    return ($connection->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$sellerID."'")); 
};

function getSellerName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['voornaam'];
};

function getSellerLastName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['naam'];
};

function getSellerProductInfo($connection, $verkoperid) {
    return ($connection->query("SELECT * FROM tblproducten WHERE verkoperid = '" . $verkoperid . "'")); 
};

function getProductPrice($connection,$productid){
    return getProduct($connection, $productid)->fetch_assoc()['prijs'];
}

function getProductSellerid($connection,$productid){
    return getProduct($connection, $productid)->fetch_assoc()['verkoperid'];
}
function getProductTime($connection,$productid){
    return getProduct($connection,$productid)->fetch_assoc()['eindtijd'];
}

function getSellerProducts($connection, $sellerID){
    $resultaat = $connection->query("SELECT * FROM tblproducten WHERE verkoperid = '".$sellerID."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
    
};
?>