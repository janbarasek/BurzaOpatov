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
<div class="sb-example-1">
         <div class="search">
            <input type="text" class="searchTerm" placeholder="What are you looking for?">
            <button type="submit" class="searchButton">
              <i class="fa fa-search"></i>
           </button>
         </div>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-search-9" viewBox="0 0 40 41">
    <path d="M25.25 32.2c-2.417 1.307-5.184 2.05-8.126 2.05C7.667 34.25 0 26.58 0 17.123 0 7.667 7.667 0 17.124 0 26.582 0 34.25 7.667 34.25 17.124c0 3.277-.92 6.338-2.517 8.94.29.18.563.397.814.65l6.105 6.103c1.8 1.8 1.795 4.722 0 6.52-1.8 1.8-4.72 1.798-6.52 0l-6.104-6.105c-.314-.313-.572-.66-.777-1.03zm-8.126-4.116c6.053 0 10.96-4.907 10.96-10.96 0-6.052-4.907-10.96-10.96-10.96-6.052 0-10.96 4.908-10.96 10.96 0 6.053 4.908 10.96 10.96 10.96z"
    fill-rule="evenodd" />
  </symbol>
  <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-clear-4" viewBox="0 0 20 20">
    <path d="M11.664 9.877l4.485 4.485-1.542 1.54-4.485-4.485-4.485 4.485-1.54-1.54 4.485-4.485-4.485-4.485 1.54-1.54 4.485 4.484 4.485-4.485 1.54 1.542-4.484 4.485zM10 20c5.523 0 10-4.477 10-10S15.523 0 10 0 0 4.477 0 10s4.477 10 10 10z" fill-rule="evenodd"
    />
  </symbol>
</svg>

<form novalidate="novalidate" onsubmit="return false;" class="searchbox sbx-custom">
  <div role="search" class="sbx-google__wrapper">
    <input type="search" name="search" placeholder="Search..." autocomplete="off" required="required" class="sbx-custom__input">
    <button type="submit" type='submit' name='submit' title="Submit your search query." class="sbx-custom__submit">
      <svg role="img" aria-label="Search">
        <use xlink:href="#sbx-icon-search-9"></use>
      </svg>
    </button>
    <button type="reset" title="Clear the search query." class="sbx-custom__reset">
      <svg role="img" aria-label="Reset">
        <use xlink:href="#sbx-icon-clear-4"></use>
      </svg>
    </button>
  </div>
</form>
<script type="text/javascript">
  document.querySelector('.searchbox [type="reset"]').addEventListener('click', function() {  this.parentNode.querySelector('input').focus();});
</script>




<form class="form2" action="includes/login.inc.php" method="post">



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

<h3 style='font-size:25px;float:right;margin-left:250px;margin-top:-50px;text-align:center;color: white;'>".$product['itemName']."</h3>
  
        
         <img style='height: 130px;margin-top:-100px;'class='image' src='Photos/".$product['productslistid'].".png'></img>
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
         <button style='margin-top:-30px;width:150px;'class='alficek2' type='submit' name='submit'>Buy Now!</button>
    </div>
   
</form>";
    }
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