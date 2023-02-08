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
    $products =  getProductsBySearch($conn, $_POST['search']);
    echo "    <h3 class='specialh3'>Učebnice</h3>
    <hr>
    <br>";
    foreach ($products as $product){
        echo "<form class='' action='' method='post'>


    <img class='image' src='Photos/".$product['productslistid'].".png'></img>
    <div class='booktext'>
        <h3>".$product['rankid']."</h3>
        <br>
        <h3>".$product['itemName']."</h3>
        <br>
        <h3>".$product['name']."</h3>
        <br>
        <h3>".$product['year']."</h3>
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
