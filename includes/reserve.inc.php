<?php
include_once 'dbh.inc.php';
include_once 'functions.inc.php';
session_start();

if(!isset($_SESSION['id'])){
    header("Location: ../login.php");
    exit();
}

if(isset($_POST['submitbuy'])){
    $buyerid = $_SESSION['id'];
    $productid = $_POST['productid'];
    $dateTime = date("Y-m-d H:i:s");

    $result = mysqli_query($conn, "UPDATE products SET buyTime = '$dateTime', buyerid = '$buyerid' WHERE id = '$productid'");



}