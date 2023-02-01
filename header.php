<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css"></link>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login system</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>

        <?php
    include_once 'header.php';
?>
    

<nav class="menu-container">

  <input type="checkbox" aria-label="Toggle menu" />
  <span></span>
  <span></span>
  <span></span>


  <a href="index.php" class="opatak">
    OPATOV</a>


  
  <div class="menu">
    <ul>
      <li>
        <a href="index.php">
          Home
        </a>
      </li>
      <li>
        <a href="#pricing">
          Buy
        </a>
      </li>
      <li>
        <a href="#blog">
          Sell
        </a>
      </li>
      <li>
        <a href="#docs">
          Profile
        </a>
      </li>
    </ul>
    <ul>
      <li>
        <a class="signup" href="signup.php">
          Sign-up
        </a>
      </li>
      <li>
        <a class="login" href="login.php">
          Login
        </a>
      </li>
    </ul>
  </div>
</nav>
<ul>
        <li><a href="index.php">Home</a></li>
        <?php
            //debugging
            if (isset($_SESSION["id"])){
                echo "<li><a href='profile.php'>Profile page</a></li>";
                echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
            }
            else{
                echo "<li><a href='signup.php'>Sign Up</a></li>";
                echo "<li><a href='login.php'>Log In</a></li>";
            }
        ?>
        </ul>
