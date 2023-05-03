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
getStatusByID($conn, $product['statusid'])['name'] = jmeno statusu
getRankByID($conn, $product['rankid'])['name'] = jmeno hodnoceni knihy


$product['id'] = id produktu
$product['userid'] = id prodejce
$product['productslistid'] = id knihy
$product['rankid'] = id hodnoceni
$product['statusid'] = id statusu
$product['price'] = cena
$product['buyerid'] = id kupujiciho
$product['buyTime'] = cas kdy byla kniha koupena
$product['name'] = jmeno prodavajiciho
$product['surname'] = prijmeni prodavajiciho
$product['class'] = trida prodavajiciho
$product['email'] = email prodavajiciho
$product['password'] = heslo prodavajiciho (zahasovane)
$product['rights'] = prava prodavajiciho (0 normalni uzivatel, 1 admin)
$product['cookies'] = cookies prodavajiciho (nefunguje)
$product['points'] = body prodavajiciho (nefunguje)
$product['rank'] = hodnoceni prodavajiciho (nefunguje)
$product['subjectid'] = id predmetu
$product['itemName'] = nazev knihy
$product['year'] = rocnik knihy
$product['publishYear'] = rok vydani knihy
$product['subjectName'] = nazev predmetu

*/


print_r($product);




include_once 'errorHandler.php';

include_once 'footer.php';
