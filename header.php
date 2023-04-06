<?php
    session_start();
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';
include_once '../Burza/phpMailer/mailFirstLevel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burza Opatov</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>

    

<nav class="menu-container">

  <input type="checkbox" aria-label="Toggle menu" />
  <span></span>
  <span></span>
  <span></span>

    <?php

    $notification = 0;

    if(isset($_SESSION['id'])){
        foreach (getProductsBySellerID($conn, $_SESSION['id']) as $product) {
            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                    echo "<img src='Photos/loser2.png' class='messageShow'></img>";
                    $notification = 1;
                    break;
                }
            }
        }
        foreach (getProductsByBuyerID($conn, $_SESSION['id']) as $product) {
            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                    if($notification == 0){
                        echo "<img src='Photos/loser2.png' class='messageShow'></img>";
                        break;
                    }
                }
            }
        }
    }
    ?>

  <a href="index.php" class="opatak">
    BURZA</a><p style="color: tomato">Testovací provoz</p>


  
  <div class="menu">
    <ul>
      <li>
        <a href="index.php">
          Domů
        </a>
      </li>
      <li>
        <a href="sell.php">
          Prodat
        </a>
      </li>
        <?php

        if (isset($_SESSION["id"])){
            echo "<li>
                    <a href='profile.php'>
                    Účet
                    ";

            foreach (getProductsBySellerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        echo "<img src='Photos/loser2.png' style='margin-top:0px;float:right;    margin-right: 0px;'class='messageShow'></img>";
                        $notification = 1;
                        break;
                    }
                }
            }
            foreach (getProductsByBuyerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        if($notification == 0){
                            echo "<img style='margin-:30px;'src='Photos/loser2.png' class='messageShow'></img>";
                            break;
                        }
                    }
                }
            }
            echo "</a>
                </li>";
            echo "<li><a href='includes/logout.inc.php'>Odhlásit</a></li>";
        }
        else{
            echo "<li><a href='signup.php'>Registrovat</a></li>";
            echo "<li><a href='login.php'>Přihlásit</a></li>";
        }
        ?>
    </ul>
  </div>
</nav>
