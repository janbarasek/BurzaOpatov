<?php
include_once 'dbh.inc.php';
include_once 'functions.inc.php';
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submitbuy'])){
    $email = str_replace("\r\n","",$_POST['email']);
    if(empty($email)){

        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    if (strlen($email) < 10 || strlen($email) > 500) {
        header("Location: ../index.php?error=invalidemailength");
        exit();
    }
    if(!isset($_SESSION['id'])){
        header("Location: ../login.php");
        exit();
    }
    $buyerid = $_SESSION['id'];
    $productid = $_POST['productid'];
    $dateTime = date("Y-m-d H:i:s");
    $sellerid = getProductByID($conn, $productid)['userid'];

    $resultMessage = mysqli_query($conn, "INSERT INTO message (userid, productid, count, message, dateTime, recieverid) VALUES ('$buyerid', '$productid', '1', '$email', '$dateTime','$sellerid')");
    $result = mysqli_query($conn, "UPDATE products SET buyTime = '$dateTime', buyerid = '$buyerid',statusid = 2 WHERE id = '$productid'");

    header("Location: ../index.php?success=buy");
}