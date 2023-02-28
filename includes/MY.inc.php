<?php
include_once 'dbh.inc.php';
include_once 'functions.inc.php';
include_once '../../Burza/phpMailer/mail.php';
session_start();

if(isset($_GET['issue'])){
    $issue = $_GET['issue'];
    $id = $_GET['id'];
    $return = $_GET['return'];

    if ($issue == 'resell') {
        mysqli_query($conn, "UPDATE message SET isVisible = 0 WHERE productid = '$id'");
        mysqli_query($conn, "UPDATE products SET statusid = 1 WHERE id = '$id'");
        mysqli_query($conn, "UPDATE products SET buyerid = null WHERE id = '$id'");
        mysqli_query($conn, "UPDATE products SET buyTime = null WHERE id = '$id'");
        header("Location: ../".$return);
        exit();
    }

    if ($issue == 'markassold') {
        $result = mysqli_query($conn, "UPDATE products SET statusid = 3 WHERE id = '$id'");

        header("Location: ../".$return);
        exit();
    }
}

if(isset($_GET['submitmessage'])){
    if(!isset($_SESSION['id'])){
        header("Location: ../login.php");
        exit();
    }

    $message = $_GET['message'];
    $productid = $_GET['productid'];
    $userid = $_SESSION['id'];

    if (strlen($message) < 1 || strlen($message) > 500) {
        header("Location: ../contact.php?id=".$productid."&error=invalidmessage&return=".$_GET['return']);
        exit();
    }

    if(getProductByID($conn, $productid)['buyerid'] == $userid){
        $recieverid = getProductByID($conn, $productid)['userid'];
    } else {
        $recieverid = getProductByID($conn, $productid)['buyerid'];
    }


    $lastMessagecount =  getMessageByProductIDDesc($conn, $productid)[0]['count'];
    $lastMessagecount = $lastMessagecount + 1;


    sendMessage($conn, $userid, $productid, $lastMessagecount, $message, $recieverid, "New message from user ".getUserByID($conn, $userid)['name']." ".getUserByID($conn, $userid)['surname']);
    header("Location: ../contact.php?id=".$productid."&return=".$_GET['return']);
    exit();
}