<?php
include_once 'dbh.inc.php';
include_once 'functions.inc.php';
session_start();

if(isset($_GET['issue'])){
    $issue = $_GET['issue'];
    $id = $_GET['id'];

    if ($issue == 'resell') {
        mysqli_query($conn, "UPDATE products SET statusid = 1 WHERE id = '$id'");
        mysqli_query($conn, "UPDATE products SET buyerid = null WHERE id = '$id'");
        mysqli_query($conn, "UPDATE products SET buyTime = null WHERE id = '$id'");
        header("Location: ../mySells.php");
        exit();
    }

    if ($issue == 'markassold') {
        $result = mysqli_query($conn, "UPDATE products SET statusid = 3 WHERE id = '$id'");
        header("Location: ../mySells.php");
        exit();
    }
}

if(isset($_GET['submitmessage'])){
    $message = $_GET['message'];
    $productid = $_GET['productid'];
    $userid = $_SESSION['id'];
    $dateTime = date("Y-m-d H:i:s");

    $lastMessagecount =  getMessageByProductIDDesc($conn, $productid)[0]['count'];
    $lastMessagecount = $lastMessagecount + 1;

    $result = mysqli_query($conn, "INSERT INTO message (userid, productid, count, message, dateTime) VALUES ('$userid', '$productid', '$lastMessagecount', '$message', '$dateTime')");
    header("Location: ../contact.php?id=".$productid);
    exit();
}