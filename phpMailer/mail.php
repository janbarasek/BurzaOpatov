<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


require '../phpMailer/PHPMailer/phpmailer/src/Exception.php';
require '../phpMailer/PHPMailer/phpmailer/src/PHPMailer.php';
require '../phpMailer/PHPMailer/phpmailer/src/SMTP.php';

if(isset($_GET["send"])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'paveedisk1@gmail.com';
    $mail->Password = 'pfzeivvbdbbenqgx';

    $mail->SMTPSecure = 'ssl';
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Port = 465;

    $mail->setFrom('paveedisk1@gmail.com');

    $mail->addAddress($_GET['address']);

    $mail->isHTML(true);
    $mail->Subject = $_GET["subject"];
    $mail->Body = $_GET["message"];

    $mail->send();

    echo
    "
    <script>
    alert('Your message was sent succesfully! Thank you!');
    
    </script>

    ";
}

//Create a new PHPMailer instance
/*$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "paveedisk1@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "pfzeivvbdbbenqgx";

$mail->Subject = "neco";
$mail->Body = "neco body";

//Set who the message is to be sent from
$mail->setFrom('paveedisk1@example.com', 'First Last');

//Set an alternative reply-to address
$mail->addReplyTo('paveedisk1@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress('paveedisk1@example.com', 'John Doe');

$mail->Send();

print_r($mail);*/

//}
?>