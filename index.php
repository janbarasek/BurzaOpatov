<<<<<<< HEAD
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css"></link>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@100&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&family=Roboto:wght@100&display=swap" rel="stylesheet">
	<title></title>
</head>
<body>

     
      
=======
<?php
include_once 'header.php';
?>

<br>
<br>
<br>
>>>>>>> 1962f726e97943219f5fc084399230195b9ad90f

<nav class="menu-container">
  <!-- burger menu -->
  <input type="checkbox" aria-label="Toggle menu" />
  <span></span>
  <span></span>
  <span></span>

  <!-- logo -->
  <a href="index.php" class="menu-logo">
    OPATOV</a>

<<<<<<< HEAD
  <!-- menu items -->
  <div class="menu">
    <ul>
      <li>
        <a href="#home">
          Something
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
<?php
    include_once 'header.php';
?>
=======
>>>>>>> 1962f726e97943219f5fc084399230195b9ad90f

<?php
if (isset($_SESSION["id"])){
    echo "<p> Hello " . $_SESSION["id"] . "!</p>";
}
?>
<p>
    This is the index page.
</p>



<?php
    include_once 'footer.php';
?>