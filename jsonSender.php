<?php
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';


$list = [];

foreach (getProducts($conn) as $product) {
if ($product['statusid'] == 1) {
$myObj = new stdClass();
$myObj->image = 'Photos/books/' . $product['productslistid'];##TODO need to send name with format (now is format missing)
$myObj->price = $product['price'];
$myObj->name = $product['name'];
$myObj->surname = $product['surname'];
$myObj->state = getRankByID($conn, $product['rankid'])['name'];
$myObj->book = $product['itemName'];
$myObj->date = $product['buyTime'];##TODO add variable for time, when the book was added - it tells a lot about the book
$myObj->link = "includes/MY.inc.php?issue=markassold&id=".$product['id']."&return=myOrders.php";##WIP wrong link i am gonna fix this ASAP (david)

array_push($list, $myObj);
}}

$myJSON = json_encode($list);
echo $myJSON;
?>