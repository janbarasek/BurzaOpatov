
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

     

<?php
include_once 'header.php';
?>





  


<?php
if (isset($_SESSION["name"])){
    echo "<p style='color: red;margin-top:-25px;font-family:Poppins,sans-serif;justify-content:center;display:flex;text-align:center;font-weight:600;font-size:30px;background-color:black;'> Hello " . $_SESSION["name"] . " and welcome to BURZA OPATOV!</p>";
}
?>


<?php
    include_once 'includes/functions.inc.php';


    /*echo "<form class='form specialformdelete' action='includes/login.inc.php' method='post'>
        <h3 class='specialh3'>Učebnice</h3>
        <hr>
        <br>
       
        <img class='image' src='Photos/biologie.png'></img>
         <div class='booktext'>
         <h3>Biologie</h3>
        <br>
         <h3>STARS</h3>
           <br>
         <h3>Name</h3>
          <br>
         <h3>Name</h3>
           <br>
         <h3>100</h3>
         </div>
        <button class='alficek' type='submit' name='submit'>Buy Now!</button>
    </form>";*/
?>


<?php
    include_once 'footer.php';
?>