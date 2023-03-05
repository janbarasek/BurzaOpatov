<?php
include_once 'header.php';
?>

<style>
	body {
		background: #555 !important;
	}
</style>

<?php
/*if (isset($_SESSION["name"])){
    echo "<p style='color: red;margin-top:-25px;font-family:Poppins,sans-serif;justify-content:center;display:flex;text-align:center;font-weight:600;font-size:30px;background-color:black;'> Hello " . $_SESSION["name"] . " and welcome to BURZA OPATOV!</p>";
}
*/?>
    <form class='' action='index.php' method='post'>
        <h3 class='specialh3'>SEARCH</h3>
        <hr>
        <br>
        <input class='search' type='text' name='search' placeholder='Search...' <?php if (isset($_POST['search'])) echo "value=" . $_POST['search']?>>

        <input type="checkbox" name="moreBooks" value="moreBooks" <?php if (isset($_POST['moreBooks'])) echo "checked"?>>
        <label for="morebooks">More books</label>
        <br>
        <!--<div class="pricerangebox">
            <h3>PRICE</h3>
            <div class="pricevalues">
                <div>$<span id="first"></span></div>
            </div>
        https://www.instagram.com/reel/CnKBDNnhcWa/?igshid=MDJmNzVkMjY=
        </div>-->

        <div class='radioIndex'>
						<input type='radio' name='year' value='' <?php if (!isset($_POST['year']))echo "checked"?>>
						<label for='year'>Select a year</label>
						<?php
							for ($year = 4; $year <= 8; $year++) {
								echo '<input type=\'radio\' name=\'year\' value=\'4\' ';
								echo (isset($_POST['year']) && $_POST['year'] === $year ? 'checked' : '') . '>';
								echo '<label for=\'year\'>' . $year . '.</label>';
							}
						?>
        </div>


        <select name="subjectid">

            <option name="subjectid" value="" <?php if (isset($_POST['subjectid'])) if ($_POST['subjectid'] == "") echo "selected"?>>Choose a subject..</option>

            <?php
            $subjects = getSubjects($conn);
            foreach($subjects as $subject){
                if(isset($_POST['subjectid']))
                    if($_POST['subjectid'] == $subject['subjectid'])
                        echo "<option name='subjectid' value='".$subject['subjectid']."' selected>".$subject['subjectName']."</option>";
                    else
                        echo "<option name='subjectid' value='".$subject['subjectid']."'>".$subject['subjectName']."</option>";
                else
                    echo "<option name='subjectid' value='".$subject['subjectid']."'>".$subject['subjectName']."</option>";

            }
            ?>
        </select>
        <select name="rankid">

            <option name="rankid" value="" selected="selected">Choose a rank..</option>

            <?php
            $ranks = getRanks($conn);
            foreach($ranks as $rank){
                if(isset($_POST['rankid']))
                    if($_POST['rankid'] == $rank['id'])
                        echo "<option name='rankid' value='".$rank['id']."' selected>".$rank['name']."</option>";
                    else
                        echo "<option name='rankid' value='".$rank['id']."'>".$rank['name']."</option>";
                else
                echo "<option name='rankid' value='".$rank['id']."'>".$rank['name']."</option>";
            }
            ?>
        </select>
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

        <button class='alficek' type='submit' name='submitsearch'>Search</button>
    </form>

    <form action="index.php" method="post">
        <?php


        //SHOW THE BOOKS

        if(isset($_POST['submitsearch'])){

            $search = mysqli_real_escape_string($conn, $_POST['search']);
            $rankid = mysqli_real_escape_string($conn, $_POST['rankid']);
            if (isset($_POST['year'])){
                $year = mysqli_real_escape_string($conn, $_POST['year']);
            }else{
                $year = null;
            }
            $subjectid = mysqli_real_escape_string($conn, $_POST['subjectid']);

            $fromSlider = mysqli_real_escape_string($conn, $_POST['fromSlider']);
            $toSlider = mysqli_real_escape_string($conn, $_POST['toSlider']);

            if (!is_int($fromSlider) && is_int($toSlider))
                die("Please enter a valid number");


            if(isset($_POST['moreBooks'])){
                $moreBooks = true;
            }else{
                $moreBooks = false;
            }

            $products =  getProductsBySearch($conn, $_POST['search']);

            $products2 = getProductsByPrice($conn, $fromSlider, $toSlider);

            $products3 = getProductsByRank($conn, $rankid);

            $products4 = getProductsByYear($conn, $year);

            $products5 = getProductsBySubjectID($conn, $subjectid);

            /*
            Debugging
            print_r($products);
            print_r($products2);
            print_r($products3);
            print_r($products4);
            echo mysqli_real_escape_string($conn, $_POST['subjectid']) . "dfsadasdasd";
            print_r($products5);*/

            if($products == null && $products2 == null && $products3 == null && $products4 == null && $products5 == null){
                echo "<h3 class='specialh3'>No results found</h3>";
            }


            if ($rankid != null && $year != null && $subjectid != null){
                $products =  checkArrayEquality($products3, $products4, "id", "id");
                $products =  checkArrayEquality($products, $products5, "id", "id");
            }

            if ($rankid != null && $year != null){
                $products =  checkArrayEquality($products3, $products4, "id", "id");
            }

            if ($rankid != null && $subjectid != null){
                $products =  checkArrayEquality($products3, $products5, "id", "id");
            }

            if ($year != null && $subjectid != null){
                $products =  checkArrayEquality($products4, $products5, "id", "id");
            }

            if ($rankid != null){
                $products =  checkArrayEquality($products, $products3, "id", "id");
            }

            if ($year != null){
                $products =  checkArrayEquality($products, $products4, "id", "id");
            }

            if ($subjectid != null){
                $products =  checkArrayEquality($products, $products5, "id", "id");
            }

            $products =  checkArrayEquality($products, $products2, "id", "id");

            /*
             Not currently used
             print_r($products);

            if($products == null){
                echo "<h3 class='specialh3'>No results found</h3>";
            }

            $newProducts = array();

            foreach ($products as $product){
                if (!in_array($product, $newProducts)){
                    array_push($newProducts, $product);
                }
            }*/



            foreach ($products as $product){
                $filename = 'Photos/'.$product['productslistid'].'*';
                $fileinfo = glob($filename);
                echo "
<h3 style='font-size:25px;float:right;margin-left:250px;margin-top:-50px;text-align:center;color: white;'>".$product['itemName']."</h3>
         <h3 style='margin-right:50px;margin-top:10px;float:right;font-size:25px;color: white;'>".$product['rankid']."</h3>
    <div class='booktext'>
    <img class='image' src='".$fileinfo[0]."'></img>
    
    <div class='booktext'>
        <h3>". getRankByID($conn, $product['rankid'])['name'] ."</h3>
        <br>
        
        <br>
        <h3 style='margin-top:-30px;font-size:20px;color:white;'>".$product['name']."</h3>
        <h3>".$product['name']." ". $product['surname']."</h3>
        <br>
        <h3 style='font-size:20px;color:white;'>".$product['year']."</h3>
        <br>
        <h3 style='margin-top:-30px;font-size:25px;color:red;float:right;'>".$product['price']."</h3>
        <input type='number' name='productid' hidden='hidden' value=". $product['id'].">
         <button style='margin-top:-30px;width:150px;'class='alficek2' type='submit' name='submitbuy'>Buy Now!</button>
    </div>
  
";
                print_r($product['id']);
            }
        }


        ?>
    </form>

    <form class="form-absolute" action="includes/reserve.inc.php" method="post">
        <?php
            if(isset($_POST['submitbuy'])){
                $productid = $_POST['productid'];
                $buyerid = $_SESSION['id'];


                $product = getProductsByID($conn, $productid)[0];
                $filename = 'Photos/'.$product['productslistid'].'*';
                $fileinfo = glob($filename);
                echo "
<h3 style='font-size:25px;float:right;margin-left:250px;margin-top:-50px;text-align:center;color: white;'>".$product['itemName']."</h3>
         <h3 style='margin-right:50px;margin-top:10px;float:right;font-size:25px;color: white;'>".$product['rankid']."</h3>
    <div class='booktext'>
    <img class='image' src='".$fileinfo[0]."'></img>
    
    <div class='booktext'>
        <h3>". getRankByID($conn, $product['rankid'])['name'] ."</h3>
        <br>
        
        <br>
        <h3 style='margin-top:-30px;font-size:20px;color:white;'>".$product['name']."</h3>
        <h3>".$product['name']." ". $product['surname']."</h3>
        <br>
        <h3 style='font-size:20px;color:white;'>".$product['year']."</h3>
        <br>
        <h3 style='margin-top:-30px;font-size:25px;color:red;float:right;'>".$product['price']."</h3>
        <input type='number' name='productid' hidden='hidden' value=". $product['id'].">
         <button style='margin-top:-30px;width:150px;'class='alficek2' type='submit' name='submitbuy'>Reserve Now!</button>
    </div>
  
";
            }
        ?>

    </form>


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

    <style type="text/css">
        .sbx-custom {
            display: inline-block;
            position: relative;
            width: 500px;
            height: 41px;
            white-space: nowrap;
            box-sizing: border-box;
            font-size: 14px;
        }

        .sbx-custom__wrapper {
            width: 100%;
            height: 100%;
        }

        .sbx-custom__input {
            display: inline-block;
            -webkit-transition: box-shadow .4s ease, background .4s ease;
            transition: box-shadow .4s ease, background .4s ease;
            border: 0;
            border-radius: 4px;
            box-shadow: inset 0 0 0 3px #000000;
            background: #FFFFFF;
            padding: 7px;
            padding-right: 0px;
            padding-left: 11px;
            width: 150px;
            height: 45px;

            vertical-align: middle;
            white-space: normal;
            font-size: inherit;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

        .sbx-custom__input::-webkit-search-decoration, .sbx-custom__input::-webkit-search-cancel-button, .sbx-custom__input::-webkit-search-results-button, .sbx-custom__input::-webkit-search-results-decoration {
            display: none;
        }

        .sbx-custom__input:hover {
            box-shadow: inset 0 0 0 3px black;
        }

        .sbx-custom__input:focus, .sbx-custom__input:active {
            outline: 0;
            box-shadow: inset 0 0 0 3px #000000;
            background: #FFFFFF;
        }

        .sbx-custom__input::-webkit-input-placeholder {
            color: #AAAAAA;
        }

        .sbx-custom__input::-moz-placeholder {
            color: #AAAAAA;
        }

        .sbx-custom__input:-ms-input-placeholder {
            color: #AAAAAA;
        }

        .sbx-custom__input::placeholder {
            color: #AAAAAA;
        }

        .sbx-custom__submit {
            position: absolute;
            top: 10px;

            right: 301px;
            margin: 0;
            border: 0;
            border-radius: 0 3px 3px 0;
            background-color: #3e82f7;
            padding: 6px;
            width: 49px;
            height: 100%;
            vertical-align: middle;
            text-align: center;
            font-size: inherit;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .sbx-custom__submit::before {
            display: inline-block;
            margin-right: -4px;
            height: 100%;
            vertical-align: middle;
            content: '';
        }

        .sbx-custom__submit:hover, .sbx-custom__submit:active {
            cursor: pointer;
        }

        .sbx-custom__submit:focus {
            outline: 0;
        }

        .sbx-custom__submit svg {
            width: 25px;
            height: 25px;
            vertical-align: middle;
            fill: #FFFFFF;
        }

        .sbx-custom__reset {
            display: none;
            position: absolute;
            top: 10px;
            right: 56px;
            margin: 0;
            border: 0;
            background: none;
            cursor: pointer;
            padding: 0;
            font-size: inherit;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            fill: rgba(0, 0, 0, 0.5);
        }

        .sbx-custom__reset:focus {
            outline: 0;
        }

        .sbx-custom__reset svg {
            display: block;
            margin-left: -125px;
            margin-top: 8px;
            width: 25px;
            height: 25px;


        }

        .sbx-custom__input:valid ~ .sbx-custom__reset {
            display: block;
            -webkit-animation-name: sbx-reset-in;
            animation-name: sbx-reset-in;
            -webkit-animation-duration: .15s;
            animation-duration: .15s;
        }

        @-webkit-keyframes sbx-reset-in {
            0% {
                -webkit-transform: translate3d(-20%, 0, 0);
                transform: translate3d(-20%, 0, 0);
                opacity: 0;
            }
            100% {
                -webkit-transform: none;
                transform: none;
                opacity: 1;
            }
        }

        @keyframes sbx-reset-in {
            0% {
                -webkit-transform: translate3d(-20%, 0, 0);
                transform: translate3d(-20%, 0, 0);
                opacity: 0;
            }
            100% {
                -webkit-transform: none;
                transform: none;
                opacity: 1;
            }
        }
    </style>


<?php
    include_once 'footer.php';
?>