<?php
    include_once 'header.php';
    include_once 'includes/functions.inc.php';
    include_once 'includes/dbh.inc.php';

    if(!isset($_SESSION['id'])){
        header("Location: index.php");
        exit();
    }
?>

<form class="form" action="includes/sell.inc.php" method="POST">
    <br>
    <br>
    <h3>Sell</h3>
    <select name="productslistid" required>

        <option name="productslistid" value="" selected="selected">Choose an id...</option>

        <?php
            $productslist = getProductslist($conn);
            foreach($productslist as $product){
                echo "<option name='productslistid' value='".$product['id']."'>".$product['year'] ." - " .$product['name']." - ". $product['publishYear']."</option>";
            }
        ?>
        <option name="productslistid" value="new">ID is not here</option>
    </select>
    <br>
    <select name="rankid" required>

        <option name="rankid" value="" selected="selected">Choose a rank..</option>

        <?php
            $ranks = getRanks($conn);
            foreach($ranks as $rank){
                echo "<option name='rankid' value='".$rank['id']."'>".$rank['name']."</option>";
            }
        ?>
    </select>
    <br>
    <input type="number" name="price" placeholder="Price..." required>
    <h1><?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "emptyinput") {
                echo "<p style='font-size:20px;margin-top:20px;justify-content: center;display: flex;color:red;'>Fill in all fields!</p>";
            }
            else if ($_GET["error"] == "price") {
                echo "<p style='font-size:20px;margin-top:20px;justify-content: center;display: flex;color:red;'>Price is invalid</p>";
            } else if ($_GET["error"] == "stmtfailed") {
                echo "<p style='font-size:20px;margin-top:20px;justify-content: center;display: flex;color:red;'>Something went wrong, try again!</p>";
            } else if ($_GET["error"] == "none") {
                echo "<p style='font-size:20px;margin-top:20px;justify-content: center;display: flex;color:green;'>Your product is waiting for a customer, good job</p>";
            }
        }
        ?></h1>
    <button class="alficek" type="submit" name="submit">Sell</button>
</form>

<?php
    include_once 'footer.php';
?>
