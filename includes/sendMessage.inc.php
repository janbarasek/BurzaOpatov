<?php
if(isset($_GET['submit'])){
    include_once 'dbh.inc.php';
    include_once 'functions.inc.php';
    include_once '../phpMailer/mailSecondLevel.php';

    $message = $_GET['message'];
    $senderid = $_GET['senderid'];
    $recieverid = $_GET['recieverid'];
    $productid = $_GET['productid'];
    $count = $_GET['count'];
    $subject = $_GET['subject'];
    $return = $_GET['return'];

    if (strlen($message) < 1 || strlen($message) > 500) {
        header("Location: ../contact.php?id=".$productid."&error=invalidmessage&return=".$return);
        exit();
    }

    $sql = "INSERT INTO message (userid, productid, count, message, dateTime, recieverid)
        VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    $dateTime = date("Y-m-d H:i:s");

    mysqli_stmt_bind_param($stmt, "ssssss",  $senderid, $productid, $count, $message, $dateTime, $recieverid); // s = string
    mysqli_stmt_execute($stmt);

    $address = getUserByID($conn, $recieverid)["email"];

    sendMailFromSendMessage($address, $subject, $message, $return);

    mysqli_stmt_close($stmt);
}

function sendMailFromSendMessage($address, $subject, $body, $return){

    sendMail($address, $subject, $body);

    header("Location: ".$return);

}