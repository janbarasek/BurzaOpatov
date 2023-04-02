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
<h1 style='float:right;margin-right:10%;'>Matematika 6</h1>
<hr style='padding:1px;margin-top:23px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -25px;'>Třída/Předmět</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 90px;background-color:black;'>
    <?php

if(getClassByUserID($conn, $_SESSION['id'])['classYear'] == 4){
    echo '
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="">Choose a year..</input>
        <input style="margin-left:5px;" type="radio" name="year" value="4" checked><label style="margin-top:0px"> 4. </label></input>
        <input style="display:inline-block;
        " type="radio" name="year" value="5"><label style="margin-top: -60px;"> 5. </label></input>
        <input style="display:inline-block;float:left;" type="radio" name="year" value="6"><label> 6.  </label></input>
        <input style="display:inline-block;float:left;" type="radio" name="year" value="7"><label> 7.  </label></input>
        <input style="display:inline-block;float:left;" type="radio" name="year" value="8"><label> 8.  </label></input>';
}else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 5){
    echo '

        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="">Choose a year..</option>

        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="4"><label> 4.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="5" checked><label> 5.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="6"><label> 6.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="7"><label> 7.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="8"><label> 8.  </label></input>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 6){
    echo '
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="">Choose a year..</option>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="4"><label> 4.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="5"><label> 5.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="6" checked><label> 6.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="7"><label> 7. </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="8"><label> 8. </label></input>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 7){
    echo '
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="">Choose a year..</option>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="4"><label> 4.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="5"><label> 5.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="6"><label> 6.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="7" checked><label> 7.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="8"><label> 8.  </label></input>';
} else if (getClassByUserID($conn, $_SESSION['id'])['classYear'] == 8){
    echo '
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="">Choose a year..</option>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="4"><label> 4.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="5"><label> 5.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="6"><label> 6.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="7"><label> 7.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="8" checked><label> 8.  </label></input>';
} else {
    echo '
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="" checked>Choose a year..</option>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="4"><label> 4.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="5"><label> 5.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="6"><label> 6.  </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="7"><label> 7. </label></input>
        <input style="display:inline-block;margin-left:22%;" type="radio" name="year" value="8"><label> 8.  </label></input>';
}

    ?>

        <input style="display:inline-block;margin-left:22%;" type="radio" name="subjectid" value="" checked="selected">Choose a subject..</option>

        <?php
        $subjects = getSubjects($conn);
        foreach($subjects as $subject){
            echo "<input style='display:inline-block;margin-left:0%;' type='radio' name='subjectid' value='".$subject['subjectid']."'>".$subject['subjectName']."</option>";
        }
        ?>
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
        <br>
        <br>
        <br>
        <br>
        <br>
<hr style='padding:1px;margin-top:0px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -12px;'>Návrhy učebnic</h3>
<hr style='padding:1px;margin-top:-10px;float:right;width: 85px;background-color:black;'>
<?php
    if(isset($_GET['year']) && isset($_GET['subjectid'])){
        $year = $_GET['year'];
        $subjectid = $_GET['subjectid'];

        $productsid = getProductsListYearSubjectid($conn, $year, $subjectid);

        if(empty($productsid)){
            echo "Žádné učebnice nebyly nalezeny";
        }

        foreach($productsid as $productid){
            $product = getProductsListByID($conn, $productid['productslistid']);
            echo "<input style='display:inline-block;margin-left:5px;'type='radio' name='productslistid' value='" .$product[0]['productslistid']."' required ><label> ".$product[0]['itemName']." - ". $product[0]['publishYear']."</label><br>";
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