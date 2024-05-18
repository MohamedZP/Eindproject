<?php
function getAllCategories($connection){
    $resultaat =$connection->query("SELECT * FROM tblcategorie");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getCategorieColor($connection){
    $resultaat =$connection->query("SELECT * FROM tblkleur ");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function updateUser($connection, $userid, $fname, $name, $email, $password, $profile_picture, $desc){
    if (empty($profile_picture)) {
        if (getProfilePicture($connection, $userid)) {
            $profile_picture = getProfilePicture($connection, $userid);
        } else {
            print $connection->error;
        }
    }
    if (empty($password)) {
        $sql = "UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $name . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' where gebruikerid = '" . $userid . "'";
        return ($connection->query($sql));
    } else {
        $password = convertPasswordToHash($password);

        return ($connection->query("UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $name . "',
        wachtwoord = '" . $password . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' where gebruikerid = '" . $userid . "'"));
    }
}
function convertPasswordToHash($password){
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedpassword;

}   
function checkIfAdmin($connection, $email, $wachtwoord){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '" . $email . "' AND wachtwoord = '" . $wachtwoord . "'  AND admin=1");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function getUser($connection,$userid){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '".$userid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getProfilePicture($connection,$userid){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '".$userid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['profielfoto'];
}


function getGebruikersid($connection,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['gebruikerid'];
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
function addProduct($connection,$naam, $beschrijving, $prijs, $categorie,$kleur ,$foto){
    return($connection ->query("INSERT INTO tblproducten (naam, beschrijving, prijs, categorie,kleur, foto ) VALUES ('".$naam."','".$beschrijving."','" .$prijs."','" .$categorie."','".$kleur."','".$foto."')"));
}
?>
