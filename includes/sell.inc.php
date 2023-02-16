<?php

if(isset($_POST['submit'])){
    session_start();

    if(!isset($_SESSION['id'])) {
        header("location: ../login.php");
        exit();
    }
    $userid = $_SESSION['id'];
    $productslistid = $_POST['productslistid'];
    $rankid = $_POST['rankid'];
    $price = $_POST['price'];

    include_once 'functions.inc.php';
    include_once 'dbh.inc.php';

    if(emptyInputSell($userid, $productslistid, $rankid, $price) !== false){
        header("location: ../sell.php?error=emptyinput");
        exit();
    }

    if(minmax($price, 0, 100000) !== true){
        header("location: ../sell.php?error=price");
        exit();
    }

    if($productslistid == "new"){
        header("location: ../addproduct.php");
        exit();
    }
    createItem($conn, $userid, $productslistid, $rankid, $price);
}



