<?php
include_once 'header.php';
?>

<form class='' action='buy.php' method='post'>
    <h3 class='specialh3'>SEARCH</h3>
    <hr>
    <br>
    <input class='search' type='text' name='search' placeholder='Search...'>
    <button class='alficek' type='submit' name='submit'>Search</button>
</form>


<?php

include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';

if(isset($_POST['submit'])){
    $products =  getAllProducts($conn);

    foreach ($products as $product){
        echo "<form class='' action='' method='post'>
    <h3 class='specialh3'>Učebnice</h3>
    <hr>
    <br>

    <img class='image' src='Photos/".$product['id'].".png'></img>
    <div class='booktext'>
        <h3>Biologie</h3>
        <br>
        <h3>".$product['rankid']."</h3>
        <br>
        <h3>Name</h3>
        <br>
        <h3>Name</h3>
        <br>
        <h3>".$product['price']."</h3>
    </div>
    <button class='alficek' type='submit' name='submit'>Buy Now!</button>
</form>";
    }
}


?>



<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
    }
    else if ($_GET["error"] == "wronglogin") {
        echo "<p>Incorrect login credentials</p>";
    }
}
?>


<?php
include_once 'footer.php';
?>
