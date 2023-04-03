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
    <div style='height:80px;background-color:black;color:white;'>
    <br>

    <h3 style='margin-top:15px;float:right;margin-right:20%;'>Prodat</h3>
</div>

<img style='margin-left:5%;width:100px;margin-top:-80px;' src='Photos/books/2.jpg'></img>
<h1 style='float:right;margin-right:10%;'>Vaši knihu</h1>
<hr style='padding:1px;margin-top:23px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -25px;'>Třída/Předmět</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 90px;background-color:black;'>
    <?php

if(getClassByUserID($conn, $_SESSION['id'])['classYear'] == 4){
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4" checked><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5"><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6"><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7"><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8"><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
}else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 5){
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4"><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5" checked><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6"><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7"><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8"><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 6){
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4"><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5"><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6" checked><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7"><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8"><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 7){
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4" ><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5"><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6"><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7" checked><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8"><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 8){
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4" ><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5"><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6"><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7"><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8" checked><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
} else {
    echo '
        <div class="yearSellContainer">
        <input class="yearSell" type="radio" name="year" value="4" id="year4"><label for="year4" class="yearSellLabel"> Kvarta </label></input>
        <input class="yearSell" type="radio" name="year" value="5" id="year5"><label for="year5" class="yearSellLabel"> Kvinta </label></input>
        <input class="yearSell" type="radio" name="year" value="6" id="year6"><label for="year6" class="yearSellLabel"> Sexta  </label></input>
        <input class="yearSell" type="radio" name="year" value="7" id="year7"><label for="year7" class="yearSellLabel"> Septima  </label></input>
        <input class="yearSell" type="radio" name="year" value="8" id="year8"><label for="year8" class="yearSellLabel"> Oktáva  </label></input>
        </div>';
}

    ?>


    <div class="subjectSellContainer">
        <?php
        $subjects = getSubjects($conn);
        foreach($subjects as $subject){
            echo "<input class='subjectSell' type='radio' name='subjectid' value='".$subject['subjectid']."' id='subject".$subject['subjectid']."'><label for='subject".$subject['subjectid']."' class='subjectSellLabel'>".$subject['subjectName']."</label></<input>";
        }
        ?>
    </div>
    <h1 style="margin-left:5px;font-size:20px;">Cena</h1>
    <hr style="
    background-color: black;
    padding: 1px;
    width: 25%;
    float: right;
    margin-top: -25px;
    margin-right: 190px;
">
     <h1 style="margin-right:95px;font-size:20px;float:right;margin-top:-35px;">Kvalita</h1>
     <hr style="
 background-color: black;
 padding: 1px;
 width: 70px;
 float: right;
 margin-top: -25px;
 margin-right: -150px;">
    <button style="float:right;margin-right:-40%;margin-top:70px;width:150px;height:55px;padding:-1px;" class="alficek" type="submit" name="submit">Hledat</button>
</form>


<form class="" action="includes/sell.inc.php" method="POST">
    <br>
    <br>

    <select style="float:right;margin-right:3%;" name="rankid" required>

        <option name="rankid" value="" selected="selected">Choose a rank..</option>

        <?php
        $ranks = getRanks($conn);
        foreach($ranks as $rank){
            echo "<option name='rankid' value='".$rank['id']."'>".$rank['name']."</option>";
        }
        ?>
    </select>
    <input class="ou" style="margin-top:-10px;margin-left:5%;border:2px solid black;width: 150px;"type="number" name="price" placeholder="Cena" required min="0" max="10000">
    <h1><?php
        include_once 'errorHandler.php';
        ?></h1>
        <br>
        <br>
        <br>
        <br>

<hr style='padding:1px;margin-top:0px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -12px;' class="decorationSell">Návrhy učebnic<hr style='padding:1px;margin-top:10px;float:right;width: 85px;background-color:black;'></h3>


<?php
    if(isset($_GET['year']) && isset($_GET['subjectid'])){
        $year = $_GET['year'];
        $subjectid = $_GET['subjectid'];

        $productsid = getProductsListYearSubjectid($conn, $year, $subjectid);

        if(empty($productsid)){
            echo "<p class='draftSellLabel'>Žádné učebnice nebyly nalezeny</p>";
        }

        foreach($productsid as $productid){
            $product = getProductsListByID($conn, $productid['productslistid']);
            echo "<div class='draftSellContainer'><input class='draftSell' type='radio' name='productslistid' value='" .$product[0]['productslistid']."' id='draft" .$product[0]['productslistid']."' required ><label for='draft" .$product[0]['productslistid']."'class='draftSellLabel' > ".$product[0]['itemName']." - ". $product[0]['publishYear']."</label></div><br>";
        }
    }
    ?>

    <button style="margin-top:10px;margin-left:25%;border-radius:25px;"class="alficek" type="submit" name="submit">Prodat</button>
</form>

<?php
    include_once 'footer.php';
?>


<style>
input[value="publishYear"] {
   color: green;
}
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