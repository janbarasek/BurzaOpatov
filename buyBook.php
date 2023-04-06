<?php
include_once 'header.php';
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
<hr style='padding:1px;margin-top:-12px;float:right;width: 90px;background-color:black;'>
 <img style='float:left;margin-left:0px;
  width: 100px;margin-top:-70px;'class='image' src='" . $fileinfo[0] . "'></img>
    

        <h3 style='margin-top:0px;font-size:15px;margin-left:110px;color:gray;'>" . getRankByID($conn, $product['rankid'])['name'] . "</h3>
        <br>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-40px;margin-left:110px;color:gray;'>" . $product['name'] . " " . $product['surname'] . "</h3>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-21px;margin-left:110px;color:gray;;'> ročník " . $product['year'] . "</h3>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-20px;margin-left:110px;color:gray;'>" . $product['price'] . " Kč</h3>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-21px;margin-left:110px;color:gray;;'>vydáno " . $product['publishYear'] . "</h3>
        <br>


      

        <br>   

<hr style='padding:1px;margin-top:0px;margin-left:0px;width: 140px;background-color:black;'>
<h3 style='font-size:18px;margin-left:150px;margin-top: -12px;'>Rezervace</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 90px;background-color:black;'>
        <textarea placeholder='Vzkaz pro prodejce...' style='resize: none;padding:5px;width: 97.5%;margin-top:10px; margin-left:5px;height: 150px;' id='email' required maxlength='500' minlength='10' name='email'></textarea>

  <hr style='padding:1px;margin-top:10px;margin-left:0px;float:left;width: 160px;background-color:black;'>
<h3 style='font-size:18px;margin-left:170px;margin-top: 1px;'>Údaje</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 110px;background-color:black;'>
<img style='margin-top:33px;margin-left:10px;float:left;'src='Photos/calendar.png'></img>
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
     <img style='width: 28px;margin-top:5px;margin-left:-75px;float:left;'src='Photos/mainmap.png'></img>
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
     <img style='width: 40px;margin-top:5px;margin-left:-80px;float:left;'src='Photos/clock.png'></img>
    
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
        
         <button style='background-color:black;color:white;float:right;margin-top:3px;justify-content:center;display:flex;height:50px;width:150px;padding: 13px;margin-right:28%;border-radius:20px;'class='alficek2' type='submit' name='submitbuy'>Rezervevovat</button>

    </div>
    
    </form>
   
  
";
    include_once 'errorHandler.php';
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
        height: 690px;
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