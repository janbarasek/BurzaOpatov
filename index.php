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
 <nav class="navbar">
        <B><div class="brand-title">OPATOV</div></B>
        
        <a href="#" class="toggle-button">
          <span class="bar"></span>
          <span class="bar"></span>
          <span class="bar"></span>
         
        </a>
        <div class="navbar-links">
          <ul>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
            <li><a href="#"></a></li>
          </ul>
        </div>
      </nav>
     
 </div>
     
      
</div>
<br>
<br>
<br>

<div class="buttons">
  <b><a class="ej">PRODEJ</a></b>
   <b><a class="bi">KVARTA</a></b>
  </div> 
<br>
<br>
   <div class="buttons">
  <b><a class="ej">KVINTA</a></b>
   <b><a class="bi">SEXTA</a></b>
  </div>  
<br>
<br>
<div class="buttons">
  <b><a class="ej">SEPTIMA</a></b>
   <b><a class="bi">OKTÁVA</a></b>
  </div> 
  <br>
  <br>
<div class="buttons">
  <b><a class="ej">PROFILE</a></b>
   <b><a class="bi">TOPS</a></b>
  </div> 

  <br>
  <br>
  <br>
  <br>
  <br>

</body>
</html>
<?php
    include_once 'header.php';
?>

<?php
if (isset($_SESSION["id"])){
    echo "<p> Hello " . $_SESSION["id"] . "!</p>";
}
?>
<p>
    This is the index page.
</p>

<?php
    if(isset($_SESSION["id"])){
        echo '<p style="font-family:Arial;"> You are logged in!</p>';
    }
    else{
        echo '<p style="font-family:Arial;"> You are logged out!</p>';
    }

    print_r($_SESSION);
?>

<?php
    include_once 'footer.php';
?>