<?php
include_once 'header.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if(!isset($_GET['submit'])){
    header("Location: index.php");
    exit();
}

if(!isset($_GET['productid'])){
    header("Location: index.php");
    exit();
}

$userid = $_SESSION['id'];

$productid = $_GET['productid'];

if(getProductByID($conn, $productid)['buyerid'] != $userid){
    header("Location: index.php");
    exit();
}

echo "<h1>Rate</h1>";

$product = getProductByID($conn, $productid);

$filename = 'Photos/books/' . $product['productslistid'] . '*';

$fileinfo = glob($filename);

/*dokumentace
$fileinfo[0] = cesta k souboru pro obrazek
$product['itemName'] = nazev knihy
$product['price'] = cena knihy
$product['buyerid'] = id koho koupil
$product['buyTime'] = kdy koupil
$product['statusid']['name'] = id statusu
$product['rankid']['name'] = hodnoceni knihy

*/

echo "<div>
     <img style='' class='image' src='" . $fileinfo[0] . "'>
     </div>";

print_r($product);

include_once 'errorHandler.php';

include_once 'footer.php';
