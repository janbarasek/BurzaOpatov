<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require 'PHPMailer/phpmailer/src/Exception.php';
require 'PHPMailer/phpmailer/src/PHPMailer.php';
require 'PHPMailer/phpmailer/src/SMTP.php';

include_once '../includes/securitydata.inc.php';

function sendMessage($conn, $senderid, $productid, $count, $message, $recieverid, $subject, $return){
    $sqlcheck = "SELECT * FROM message WHERE userid = ? AND productid = ? AND recieverid = ?;";
    $stmtcheck = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmtcheck, $sqlcheck)){
        header("location: ../index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmtcheck, "sss", $senderid, $productid, $recieverid);
    mysqli_stmt_execute($stmtcheck);
    $result = mysqli_stmt_get_result($stmtcheck);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_all($result);
        $lastMessage = $row[array_key_last($row)];
    }
    mysqli_stmt_close($stmtcheck);
    if ($lastMessage[5] == $message && strtotime($lastMessage[6]) > strtotime("-10 seconds")){
        header("location: ../contact.php?id=". $productid ."&return=".$return."&error=spam");
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

    sendMail($address, $subject, $message);

    mysqli_stmt_close($stmt);
}

function sendMail($address, $subject, $body){

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = getMasterEmail();
    $mail->Password = getMasterKey(); //password -- removed for security reasons

    $mail->SMTPSecure = 'ssl';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Port = 465;

    $mail->setFrom(getMasterEmail());

    $mail->addAddress($address);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body . " <br><br><b>Sharuj tuhle apku, ať se to trochu rozjede.</b><br><i>
    Tato zpráva může být odeslána pomocí automatického systému. Prosím, neodpovídejte na tuto zprávu a omluvte možné chyby ve zprávě. <br> Vaše Burza Opatov. <br>
    Abyste mohli odpovědět, přihlašte se do systému</i>";

    $mail->send();
}
?>