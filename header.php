<?php
    session_start();
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';
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
                    echo "<div class='messageShow'></div>";
                    $notification = 1;
                    break;
                }
            }
        }
        foreach (getProductsByBuyerID($conn, $_SESSION['id']) as $product) {
            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                    if($notification == 0){
                        echo "<div class='messageShow'></div>";
                        break;
                    }
                }
            }
        }
    }
    ?>

  <a href="index.php" class="opatak">
    BURZA</a>


  
  <div class="menu">
    <ul>
      <li>
        <a href="index.php">
          Home
        </a>
      </li>
      <li>
        <a href="sell.php">
          Sell
        </a>
      </li>
        <?php

        if (isset($_SESSION["id"])){
            echo "<li>
                    <a href='profile.php'>
                    Profile
                    ";

            foreach (getProductsBySellerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        echo "<div class='messageShow'></div>";
                        $notification = 1;
                        break;
                    }
                }
            }
            foreach (getProductsByBuyerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        if($notification == 0){
                            echo "<div class='messageShow'></div>";
                            break;
                        }
                    }
                }
            }
            echo "</a>
                </li>";
            echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
        }
        else{
            echo "<li><a href='signup.php'>Sign Up</a></li>";
            echo "<li><a href='login.php'>Log In</a></li>";
        }
        ?>
    </ul>
  </div>
</nav>
