<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php';
include_once 'includes/functions.inc.php';


?>

<form class='' action='buy.php' method='post'>
    <h3 class='specialh3'>SEARCH</h3>
    <hr>
    <br>
    <input class='search' type='text' name='search' placeholder='Search...'>
    <br>
    <!--<div class="pricerangebox">
        <h3>PRICE</h3>
        <div class="pricevalues">
            <div>$<span id="first"></span></div>
        </div>
    https://www.instagram.com/reel/CnKBDNnhcWa/?igshid=MDJmNzVkMjY=
    </div>-->
    <div class="range_container">
        <div class="sliders_control">
            <?php

            if (isset($_POST['fromSlider']) && isset($_POST['toSlider'])) {
                $min = $_POST['fromSlider'];
                $max = $_POST['toSlider'];
                echo '<input name="fromSlider" id="fromSlider" type="range" value="' . $min . '" min="0" max="1000"/>';
                echo '<input name="toSlider" id="toSlider" type="range" value="' . $max . '" min="0" max="1000"/>';
            } else {
                echo '<input name="fromSlider" id="fromSlider" type="range" value="10" min="0" max="1000"/>';
                echo '<input name="toSlider" id="toSlider" type="range" value="900" min="0" max="1000"/>';
            }
            ?>


        </div>
        <div class="form_control">
            <div class="form_control_container">
                <div class="form_control_container__time">Min</div>
                <?php
                if(isset($_POST['fromSlider'])){
                    $min = $_POST['fromSlider'];
                    echo '<input class="form_control_container__time__input" type="number" id="fromInput" value="'.$min.'" min="0" max="1000"/>';
                } else {
                    echo '<input class="form_control_container__time__input" type="number" id="fromInput" value="10" min="0" max="1000"/>';
                }
                ?>
            </div>
            <div class="form_control_container">
                <div class="form_control_container__time">Max</div>
                <?php
                if(isset($_POST['toSlider'])){
                $max = $_POST['toSlider'];
                echo '<input class="form_control_container__time__input" type="number" id="toInput" value="'.$max.'" min="0" max="1000"/>';
                } else {
                echo '<input class="form_control_container__time__input" type="number" id="toInput" value="900" min="0" max="1000"/>';
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <select name="rankid">

        <option name="rankid" value="" selected="selected">Choose a rank..</option>

        <?php
        $ranks = getRanks($conn);
        foreach($ranks as $rank){
            echo "<option name='rankid' value='".$rank['id']."'>".$rank['name']."</option>";
        }
        ?>
    </select>

    <select name="year">

        <option name="year" value="" selected="selected">Choose a class..</option>

        <option name="year" value="4"> 4. </option>
        <option name="year" value="5"> 5. </option>
        <option name="year" value="6"> 6. </option>
        <option name="year" value="7"> 7. </option>
        <option name="year" value="8"> 8. </option>
    </select>
    <select name="subjectid">

        <option name="subjectid" value="" selected="selected">Choose a subject..</option>

        <?php
        $subjects = getSubjects($conn);
        foreach($subjects as $subject){
            echo "<option name='subjectid' value='".$subject['id']."'>".$subject['subjectName']."</option>";
        }
        ?>
    </select>
    <button class='alficek' type='submit' name='submit'>Search</button>
</form>




<?php

//SHOW THE BOOKS

if(isset($_POST['submit'])){

    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $rankid = mysqli_real_escape_string($conn, $_POST['rankid']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $subjectid = mysqli_real_escape_string($conn, $_POST['subjectid']);

    $fromSlider = mysqli_real_escape_string($conn, $_POST['fromSlider']);
    $toSlider = mysqli_real_escape_string($conn, $_POST['toSlider']);

    if (!is_int($fromSlider) && is_int($toSlider))
        die("Please enter a valid number");

    $products =  getProductsBySearch($conn, $_POST['search']);

    $products2 = getProductsByPrice($conn, $fromSlider, $toSlider);

    $products3 = getProductsByRank($conn, $rankid);

    $products4 = getProductsByYear($conn, $year);

    $products5 = getProductsBySubjectID($conn, $subjectid);

    echo "    <h3 class='specialh3'>Učebnice</h3>
    <hr>
    <br>";

    if($products == null && $products2 == null && $products3 == null && $products4 == null && $products5 == null){
        echo "<h3 class='specialh3'>No results found</h3>";
    }


    if ($rankid != null && $year != null && $subjectid != null){
        $products =  checkArrayEquality($products3, $products4);
        $products =  checkArrayEquality($products, $products5);
    }

    if ($rankid != null && $year != null){
        $products =  checkArrayEquality($products3, $products4);
    }

    if ($rankid != null && $subjectid != null){
        $products =  checkArrayEquality($products3, $products5);
    }

    if ($year != null && $subjectid != null){
        $products =  checkArrayEquality($products4, $products5);
    }

    if ($rankid != null){
        $products =  checkArrayEquality($products, $products3);
    }

    if ($year != null){
        $products =  checkArrayEquality($products, $products4);
    }

    if ($subjectid != null){
        $products =  checkArrayEquality($products, $products5);
    }

    $products =  checkArrayEquality($products, $products2);


    foreach ($products as $product){
        $filename = 'Photos/'.$product['productslistid'].'*';
        $fileinfo = glob($filename);
        echo "<form class='' action='' method='post'>


    <img class='image' src='".$fileinfo[0]."'></img>
    
    <div class='booktext'>
        <h3>". getRankByID($conn, $product['rankid'])['name'] ."</h3>
        <br>
        <h3>".$product['itemName']."</h3>
        <br>
        <h3>".$product['name']." ". $product['surname']."</h3>
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
