<?php
include_once 'header.php';
?>

    <!--SEARCH FOR THE BOOKS-->
    <form class='' action='index.php' method='post'>
       
        <input class='search' type='text' name='search'
               placeholder='Co hledáte?' <?php if (isset($_POST['search'])) echo "value=" . $_POST['search'] ?>>
        <button class='alficek' type='submit' name='submitsearch'><img class="dieGasse"                                                                       src="Photos/searchlogo.png"></img></button>
        
        <div class='radioIndex'>
            <input type='radio' name='year' value='' <?php if (!isset($_POST['year'])) echo "checked" ?>>
            <label for='year'>Select a year</label>
            <hr style='background-color: black;
    padding: 1px;
    width: 70%;
    float: right;
    margin-top: 70px;margin-right:10px;'>
            <h1 style='margin-left:5px;font-size:20px;'>Třída</h1>
                        <br>
                        <input class="houbic1" style='    margin-left: 1%;display: inline-block;width:20px;' type='radio' name='year'
                   value='4' <?php if (isset($_POST['year'])) if ($_POST['year'] == 4) echo "checked" ?>>
            <label style='font-size:14px;display: inline-block;margin-left:5px;font-family: Poppins, sans-serif;'
                   for='year'>Kvarta</label>
                   <input style='display: inline-block;width: 20px; ;' type='radio' name='year'
                   value='5' <?php if (isset($_POST['year'])) if ($_POST['year'] == 5) echo "checked" ?>>
            <label style='font-size:14px;font-family: Poppins, sans-serif;' for='year'>Kvinta</label>
            <input style='display: inline-block;width: 20px;' type='radio' name='year'
                   value='6' <?php if (isset($_POST['year'])) if ($_POST['year'] == 6) echo "checked" ?>>
            <label style='font-size:14px;display: inline-block;font-family: Poppins, sans-serif;' for='year'>Sexta</label>
            <input style='display: inline-block;width: 20px;' type='radio' name='year'
                   value='7' <?php if (isset($_POST['year'])) if ($_POST['year'] == 7) echo "checked" ?>>
            <label style='font-size:14px;display: inline-block;font-family: Poppins, sans-serif;' for='year'>Septima</label>
            <input style='display: inline-block;width: 20px;' type='radio' name='year'
                   value='8' <?php if (isset($_POST['year'])) if ($_POST['year'] == 8) echo "checked" ?>>
            <label style='font-size:15px;display: inline-block;font-family: Poppins, sans-serif;' for='year'>Oktáva</label>
            

        </div>
        <br>
        <br>
        <br>
        <hr style='background-color: black;
    padding: 1px;

    float: right;
    margin-top: 25px;
    width: 60%;

    margin-right:10px;'>
        
            <h1 style='margin-left:5px;font-size:20px;'>Předměty</h1>
        
        <!--<div class="pricerangebox">
            <h3>PRICE</h3>
            <div class="pricevalues">
                <div>$<span id="first"></span></div>
            </div>
            */
        <input type='radio' name="subjectid">

            <input type="radio" name="subjectid"
                    value="" <?php if (isset($_POST['subjectid'])) if ($_POST['subjectid'] == "") echo "selected" ?>>
                /*<input type="radio" name="rankid">*/
            </option>
/*

        https://www.instagram.com/reel/CnKBDNnhcWa/?igshid=MDJmNzVkMjY=
        </div>-->



            <?php
            $subjects = getSubjects($conn);
            foreach ($subjects as $subject) {
                if (isset($_POST['subjectid']))
                    if ($_POST['subjectid'] == $subject['subjectid'])
                        echo "<input style='display:inline-block;margin-left:22%;'type='radio' name='subjectid' value='" . $subject['subjectid'] . "' selected>" . $subject['subjectName'] . "</input>";
                    else
                        echo "<input style='display:inline-block;margin-left:22%;' type='radio' name='subjectid' value='" . $subject['subjectid'] . "'>" . $subject['subjectName'] . "</input>";
                else
                    echo "<input style='display:inline-block;margin-left:22%;' type='radio' name='subjectid' value='" . $subject['subjectid'] . "'>" . $subject['subjectName'] . "</input>";

            }
            ?>
        </select>
        <hr style='
    background-color: black;
    padding: 1px;
    width: 25%;
    float: right;
    margin-top: 25px;
    margin-right: 190px;
'>
            <h1 style='margin-left:5px;font-size:20px;'>Cena</h1>
         
            <h1 style='margin-right:95px;font-size:20px;float:right;margin-top:-35px;'>Kvalita</h1>
            <hr style='
    background-color: black;
    padding: 1px;
    width: 70px;
    float: right;
    margin-top: -25px;
    margin-right: -150px;

'>   
            <br>
                        <div style="margin-top:0px;margin-left:10px;" class="range_container">
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
<br>

<div class="form_control">
                <div class="form_control_container">
                    <div style="text-align:center;margin-top:8px;border: 2px solid black;font-size:15px;"class="form_control_container__time">Min cena</div>
                    <?php
                    if (isset($_POST['fromSlider'])) {
                        $min = $_POST['fromSlider'];
                        echo '<input style="color:black;text-align:center;border: 2px solid black;margin-top:-2px;"class="form_control_container__time__input" type="number" id="fromInput" value="' . $min . '" min="0" max="1000"/>';
                    } else {
                        echo '<input style="color:black;text-align:center;border: 2px solid black;margin-top:-2px;" class="form_control_container__time__input" type="number" id="fromInput" value="10" min="0" max="1000"/>';
                    }
                    ?>
                </div>
                <div class="form_control_container">
                    <div style="text-align:center;margin-top:8px;border: 2px solid black;font-size:15px;" class="form_control_container__time">Max cena</div>
                    <?php
                    if (isset($_POST['toSlider'])) {
                        $max = $_POST['toSlider'];
                        echo '<input style="color:black;text-align:center;border: 2px solid black;margin-top:-2px;" class="form_control_container__time__input" type="number" id="toInput" value="' . $max . '" min="0" max="1000"/>';
                    } else {
                        echo '<input style="color:black;text-align:center;border: 2px solid black;margin-top:-2px;" class="form_control_container__time__input" type="number" id="toInput" value="900" min="0" max="1000"></>';
                    }
                    ?>
                </div>
            </div>
        </div>
                </div>
      

            <select style="margin-right: 10px;height:40px;width:150px;float:right;margin-top:-200px;background-color:white;color:black;"type="radio" name="rankid" value="" selected="selected">
            <option selected disabled>Vyber kvalitu...</option>

            <?php
            $ranks = getRanks($conn);
            foreach ($ranks as $rank) {
                if (isset($_POST['rankid']))
                    if ($_POST['rankid'] == $rank['id'])
                        echo "<option style='background-color:white;color:black;' type='radio' name='rankid' value='" . $rank['id'] . "' selected>" . $rank['name'] . "</option>";
                    else
                        echo "<option style='background-color:white;color:black;' type='radio' name='rankid' value='" . $rank['id'] . "'>" . $rank['name'] . "</option>";
                else
                    echo "<option style='background-color:white;color:black;' type='radio' name='rankid' value='" . $rank['id'] . "'>" . $rank['name'] . "</option>";
            }
            ?>
        </select>
      


            </div>
           
       

    </form>


    <!--SHOW THE BOOKS-->
<?php


if (isset($_POST['submitsearch'])) {

    $search = mysqli_real_escape_string($conn, $_POST['search']);
    $rankid = mysqli_real_escape_string($conn, $_POST['rankid']);
    if (isset($_POST['year'])) {
        $year = mysqli_real_escape_string($conn, $_POST['year']);
    } else {
        $year = null;
    }
    $subjectid = mysqli_real_escape_string($conn, $_POST['subjectid']);

    $fromSlider = mysqli_real_escape_string($conn, $_POST['fromSlider']);
    $toSlider = mysqli_real_escape_string($conn, $_POST['toSlider']);

    if (!is_int($fromSlider) && is_int($toSlider))
        die("Please enter a valid number");


    if (isset($_POST['moreBooks'])) {
        $moreBooks = true;
    } else {
        $moreBooks = false;
    }

    $products = getProductsBySearch($conn, $_POST['search']);

    $products2 = getProductsByPrice($conn, $fromSlider, $toSlider);

    $products3 = getProductsByRank($conn, $rankid);

    $products4 = getProductsByYear($conn, $year);

    $products5 = getProductsBySubjectID($conn, $subjectid);

    if ($products == null && $products2 == null && $products3 == null && $products4 == null && $products5 == null) {
        echo "<h3 class='specialh3'>No results found</h3>";
    }


    if ($rankid != null && $year != null && $subjectid != null) {
        $products = checkArrayEquality($products3, $products4, "id", "id");
        $products = checkArrayEquality($products, $products5, "id", "id");
    }

    if ($rankid != null && $year != null) {
        $products = checkArrayEquality($products3, $products4, "id", "id");
    }

    if ($rankid != null && $subjectid != null) {
        $products = checkArrayEquality($products3, $products5, "id", "id");
    }

    if ($year != null && $subjectid != null) {
        $products = checkArrayEquality($products4, $products5, "id", "id");
    }

    if ($rankid != null) {
        $products = checkArrayEquality($products, $products3, "id", "id");
    }

    if ($year != null) {
        $products = checkArrayEquality($products, $products4, "id", "id");
    }

    if ($subjectid != null) {
        $products = checkArrayEquality($products, $products5, "id", "id");
    }

    $products = checkArrayEquality($products, $products2, "id", "id");

    foreach ($products as $product) {

        if ($product['buyerid'] == null) {
            $filename = 'Photos/books/' . $product['productslistid'] . '*';
            $fileinfo = glob($filename);
            echo "
            <form action='index.php' method='post'>
    

            <div class='booktext'>
             <h3 style='float: center;font-weight:600;font-size: 25px;margin-left:50%;margin-top:20px;color:black;'>" . $product['itemName'] . "</h3>
             <br>
                 <h3 style='margin-top:-10px;font-size:20px;margin-left:142px;color:black;'>" . getRankByID($conn, $product['rankid'])['name'] . "</h3>
         
                  <img style='float:left;border-radius:10px;margin-top: -80px;width: 100px;margin-left:20px;' class='image' src='" . $fileinfo[0] . "'></img>
                 <h3 style='color:gray;font-size:15px;margin-top:40px;margin-left:142px;'>" . $product['name'] . " " . $product['surname'] . "</h3>
                 <br>
           
                 
          
                 <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . ">
                  <button style='margin-top:-42px;float:right;border-radius:15px;height:30px;background-color:black;color:white;width:100px;margin-right:5px;padding:3px;margin-left:170px;'class='alficek2' type='submit' name='submitbuy'>" . $product['price'] . " Kč</button>
             </div>
             <br>
           </form>
";

        }
    }
} else {
    if (!isset($_POST['submitbuy'])) {
        $products = getProducts($conn);
        foreach ($products as $product) {
            if ($product['buyerid'] == null) {
                $filename = 'Photos/books/' . $product['productslistid'] . '*';
                $fileinfo = glob($filename);
                echo "

<form action='index.php' method='post'>
    

   <div class='booktext'>
    <h3 style='float: center;font-weight:600;font-size: 25px;margin-left:50%;margin-top:20px;color:black;'>" . $product['itemName'] . "</h3>
    <br>
        <h3 style='margin-top:-10px;font-size:20px;margin-left:142px;color:black;'>" . getRankByID($conn, $product['rankid'])['name'] . "</h3>

         <img style='float:left;border-radius:10px;margin-top: -80px;width: 100px;margin-left:20px;' class='image' src='" . $fileinfo[0] . "'></img>
        <h3 style='color:gray;font-size:15px;margin-top:40px;margin-left:142px;'>" . $product['name'] . " " . $product['surname'] . "</h3>
        <br>
  
        
 
        <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . ">
         <button style='margin-top:-42px;float:right;border-radius:15px;height:30px;background-color:black;color:white;width:100px;margin-right:5px;padding:3px;margin-left:170px;'class='alficek2' type='submit' name='submitbuy'>" . $product['price'] . " Kč</button>
    </div>
    <br>
  </form>

";
            }
        }

    }
}
?>


    <!--SHOW ONE BOOK-->

<?php
if (isset($_POST['submitbuy'])) {
    $productid = $_POST['productid'];

    if (isset($_SESSION['userid'])) {
        $buyerid = $_SESSION['userid'];
    } else {
        $buyerid = null;
    }


    $product = getProductByID($conn, $productid);
    $filename = 'Photos/books/' . $product['productslistid'] . '*';
    $fileinfo = glob($filename);
    echo "
<form class='form-absolute' action='includes/reserve.inc.php' method='post'>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class='booktext2'>
   
<h3 style='float: right;font-weight:600;font-size: 20px;margin-right:5%;margin-top:20px;color:black;'>" . $product['itemName'] . "</h3>
<hr style='padding:1px;margin-top:52px;margin-left:100px;width: 100px;background-color:black;'>
<h3 style='font-size:18px;margin-left:210px;'>Info</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 105px;background-color:black;'>
 <img style='float:left;margin-left:0px;
  width: 100px;margin-top:-90px;'class='image' src='" . $fileinfo[0] . "'></img>
    

        <h3 style='margin-top:0px;font-size:15px;margin-left:110px;color:gray;'>" . getRankByID($conn, $product['rankid'])['name'] . "</h3>
        <br>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-40px;margin-left:110px;color:gray;'>" . $product['name'] . " " . $product['surname'] . "</h3>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-21px;margin-left:110px;color:gray;;'>" . $product['year'] . "</h3>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-20px;margin-left:110px;color:gray;'>" . $product['price'] . "</h3>

        <br>



      

        <br>   

<hr style='padding:1px;margin-top:0px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -12px;'>Rezervace</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 110px;background-color:black;'>
        <textarea placeholder='Vzkaz pro prodejce...' style='resize: none;width: 97.5%;margin-top:10px; margin-left:5px;height: 150px;' id='email' required maxlength='500' minlength='10' name='email'>

</textarea>

  <hr style='padding:1px;margin-top:10px;margin-left:0px;float:left;width: 160px;background-color:black;'>
<h3 style='font-size:18px;margin-left:170px;margin-top: 1px;'>Údaje</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 130px;background-color:black;'>
<img style='margin-top:33px;margin-left:10px;float:left;'src='calendar.png'></img>
<div id='generateEmailContainer' style=' margin-left:80px;margin-top:-60px;align-items:center;' >
<br>
<br>
<br>
<br>


<input style='margin-left:-40px;width:175px;height:40px;border:2px solid gray;'type='date' name='date' id='date'>
<h1 style='margin-top: 20px;font-size:15px;float:right;margin-right:5px;'>Datum předání</h1>
<br><br>

    ";

    echo "
     <img style='width: 28px;margin-top:5px;margin-left:-75px;float:left;'src='mainmap.png'></img>
      <h1 style='margin-top: 10px;font-size:15px;float:right;margin-right:13px;'>Místo předání</h1>
     <select style='margin-left:-40px;width:175px;height:40px;border:2px solid gray;background-color:white; color:black;'name='placeid' id='place'> 

        <option style='background-color:white; color:black;' name='placeid' value=''>
Vyber místo...
        </option>";


    $places = getPlaces($conn);
    foreach ($places as $place) {
        echo "<option style='background-color:white; color:black;' name='placeid' value='" . $place['placeid'] . "'>" . $place['placeName'] . "</option>";
    }
    echo "</select>";


    echo "
    <br><br>
     <img style='width: 40px;margin-top:5px;margin-left:-80px;float:left;'src='clock.png'></img>
    
       <h1 style='margin-top: 10px;font-size:15px;float:right;margin-right:23px;'>Čas předání</h1>
<select style='margin-left:-40px;border:2px solid gray;background-color:white; color:black;width:175px;height:40px;' name='timeid' id='time'> 
        <option style='background-color:white; color:black; name='timeid' value=''>Vyber čas...</option>
        <option style='background-color:white; color:black; name='timeid' value='1'>7:40</option>
        <option style='background-color:white; color:black; name='timeid' value='2'>8:45</option>
        <option style='background-color:white; color:black; name='timeid' value='3'>9:40</option>
        <option style='background-color:white; color:black; name='timeid' value='4'>10:40</option>
        <option style='background-color:white; color:black; name='timeid' value='5'>11:40</option>
        <option style='background-color:white; color:black; name='timeid' value='6'>12:35</option>
        <option style='background-color:white; color:black; name='timeid' value='7'>13:30</option>
        <option style='background-color:white; color:black; name='timeid' value='8'>14:25</option>
        <option style='background-color:white; color:black; name='timeid' value='9'>15:20</option>
        <option style='background-color:white; color:black; name='timeid' value='10'>16:10</option>
        <option style='background-color:white; color:black; name='timeid' value='11'>17:00</option>
</select>";

}
?>


<?php
if (isset($_POST['submitbuy'])) {
    $productid = $_POST['productid'];

    if (isset($_SESSION['userid'])) {
        $buyerid = $_SESSION['userid'];
    } else {
        $buyerid = null;
    }


    $product = getProductByID($conn, $productid);
    echo "<br><br><div style='border:3px solid;width:130px;font-family: Poppins, sans-serif; font-weight:600; font-size:20px;padding: 5px;text-align:center;height:37px;float:right;margin-right:5px;' class='generateEmailBut2' onclick='generateEmail(";
    echo '"' . $_SESSION['name'] . '"';
    echo ',"' . $_SESSION['surname'] . '"';
    echo ',"' . $product['name'] . ' ' . $product['surname'] . '"';
    echo ',"' . $product['itemName'] . '"';


    echo ")'>Generovat</div>
</div>
<br>
<br>
<br>
<hr style='  border: 1px solid black;'>
        <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . ">
        

         <button style='background-color:black;color:white;float:right;margin-top:3px;justify-content:center;display:flex;height:50px;width:150px;padding: 13px;margin-right:25%;border-radius:20px;'class='alficek2' type='submit' name='submitbuy'>Rezervevovat</button>

    </div>
    
    </form>
   
  
";
}
?>
 
<!--<button style='background-color:white;border:2px solid gray;color:black;float:left;margin-top:15px;height:50px;width:150px;padding: 13px;margin-left:10px;border-radius:20px;'class='alficek2' type='submit' name='submitbuy'>Zpět</button><input type="checkbox" name="moreBooks"
               value="moreBooks" <?php if (isset($_POST['moreBooks'])) echo "checked" ?>>
        <label for="morebooks">Další knihy</label>
        <br>-->

    <!--ERROR HANDLING-->
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
    } else if ($_GET["error"] == "wronglogin") {
        echo "<p>Incorrect login credentials</p>";
    }
}
?>


<?php
include_once 'footer.php';
?>

    <style type="text/css">
        select {
            height: 50px;
            margin-left: 8px;
            display: inline-block;
            width: 180px;
        }

        input[type="radio"] {
            vertical-align: middle;
            /* Add if not using autoprefixer */
           
            margin: 0;

            font: inherit;
            color: currentColor;
            width: 1.15em;
            height: 1.15em;
            border: 0.15em solid currentColor;
            border-radius: 50%;
            transform: translateY(-0.075em);

            display: grid;
            place-content: center;
        }


        input[type="radio"]::before {
            content: "";
            width: 0.65em;
            height: 0.65em;
            border-radius: 50%;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em var(--form-control-color);
            /* Windows High Contrast Mode */
            background-color: CanvasText;
        }

        input[type="radio"]:checked::before {
            transform: scale(1);
        }

        input[type="radio"]:focus {
            outline: max(2px, 2px) solid currentColor;
            outline-offset: max(2px, 2px);
        }

        input {

            color: black;
        }

        .alficek {
            background-color: white;
            width: 50px;
            height: 50px;
            margin-top: -50px;
            margin-left: 275px;
        }


        label {
            color: black;
            display: inline-block;
        }

        input {
            display: inline-block;
        }

        ::placeholder {
            font-weight: 600;
            font-size: 17px;
            color: grey;


        }

        option {
            color: white;
        }

        select {
            color: white;
        }

.form_control_container__time__input {
    width: 20px;

}
        .booktext {
            width: 94%;
            height: 200px;
            background-color: white;
            border-radius: 5px;
            border: 4px solid;
           margin-left: 10px;
           margin: 0 auto;

           
        }

        .booktext2 {
             width: 94%;
            height: 675px;
            background-color: white;
            border-radius: 5px;
            border: 4px solid;
           margin-left: 10px;
           margin: 0 auto;

        }

        .form-absolute {
            width: 100%;
           height: auto;
            background-color: black;
          


        }

        .dieGasse {
            width: 40px;
            margin-top: -12px;
            margin-left: 1px;


        }

        .search {
            border: 5px solid;
            margin-left: 5px;
            width: 275px;

        }
textarea:focus {
     box-shadow: 0 0 8px 2px rgba(0, 0, 0, 0.2);
  outline: 0;
}
        .generateEmailContainer {
            margin: 0 auto;
        }

        .generateEmailBut {

            display: inline-block;
            width: 200px;
         margin-left: 80px;
            height: 50px;
            background-color: white;
            border-radius: 5px solid black ;
        
            margin-top: 0px;
            font-size: 20px;
            text-align: center;
            padding-top: 10px;
            z-index: 10;
        }
          .generateEmailBut2 {

            display: inline-block;
            width: 200px;
         margin-left: 0px;
            height: 50px;
            background-color: white;
            border-radius: 5px solid black ;
        
            margin-top: 0px;
            font-size: 20px;
            text-align: center;
            padding-top: 10px;
            transition: 0.5s;
            cursor: pointer;
        }


           .generateEmailBut:hover {
color: red;
transition: 0.5s;
           }

           .generateEmailBut2:hover {
color: red;
transition: 0.5s;
           }

       
        .sliders_control {
            width: 60%;
            
        }


.radioIndex {
    margin: 0 auto;
}

      
    </style>

<?php
include_once 'footer.php';
?>


<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

    </script>