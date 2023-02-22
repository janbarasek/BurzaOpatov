<?php
    include_once 'header.php';
    include_once 'includes/functions.inc.php';
    include_once 'includes/dbh.inc.php';

    if(!isset($_SESSION['id'])){
        header("Location: login.php");
        exit();
    }
?>
<form class="" action="sell.php" method="get">
    <br>

    <h3>Sell</h3>
    <?php

if(getClassByUserID($conn, $_SESSION['id'])['classYear'] == 4){
    echo '<select name="year" required>

        <option name="year" value="">Choose a year..</option>

        <option name="year" value="4" selected> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>';
}else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 5){
    echo '<select name="year" required>

        <option name="year" value="">Choose a year..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5" selected> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 6){
    echo '<select name="year" required>

        <option name="year" value="">Choose a year..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6" selected> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 7){
    echo '<select name="year" required>

        <option name="year" value="">Choose a year..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7" selected> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 8){
    echo '<select name="year" required>

        <option name="year" value="">Choose a year..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8" selected> 8. </option>
    </select>';
} else {
    echo '<select name="year" required>

        <option name="year" value="" selected>Choose a year..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>';
}

    ?>

    <select name="subjectid" required>

        <option name="subjectid" value="" selected="selected">Choose a subject..</option>

        <?php
        $subjects = getSubjects($conn);
        foreach($subjects as $subject){
            echo "<option name='subjectid' value='".$subject['subjectid']."'>".$subject['subjectName']."</option>";
        }
        ?>
    </select>

    <button class="alficek" type="submit" name="submit">Search</button>
</form>


<form class="" action="includes/sell.inc.php" method="POST">
    <br>
    <?php
    if(isset($_GET['year']) && isset($_GET['subjectid'])){
        $year = $_GET['year'];
        $subjectid = $_GET['subjectid'];

        $productsid = getProductsListYearSubjectid($conn, $year, $subjectid);

        if(empty($productsid)){
            echo "No suitable products found";
        }

        foreach($productsid as $productid){
            $product = getProductsListByID($conn, $productid['productslistid']);
            echo "<input type='radio' name='productslistid' value='".$product[0]['productslistid']."' required >".$product[0]['itemName']." - ". $product[0]['publishYear']."<br>";
        }
    }
    ?>
    <!--<select name="productslistid" required>

        <option name="productslistid" value="" selected="selected">Choose an id...</option>

        <?php
/*            $productslist = getProductslist($conn);
            foreach($productslist as $product){
                echo "<option name='productslistid' value='".$product['id']."'>".$product['year'] ." - " .$product['itemName']." - ". $product['publishYear']."</option>";
            }
        */?>
        <option name="productslistid" value="new">ID is not here</option>
    </select>-->
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
    <input class="ou" style="border:2px solid black;width: 150px;"type="number" name="price" placeholder="Price..." required min="0" max="10000">
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


<style>

select {
    color: white;

}
.ou {
    width: 150px;
    border: 2px solid;
}

option {
    color: white;
}
</style>