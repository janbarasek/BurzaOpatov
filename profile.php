<?php
include_once 'header.php'
?>

<?php
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
?>

<div class="background">
    <div class="ball"></div>
    <div class="ball"></div>
</div>

<div class="mainPartProfile">


    <h3>Profil</h3>

    <br>
    <?php
    if (isset($_SESSION['imgStatus'])) {
        if ($_SESSION['imgStatus'] == 1) {
            $id = $_SESSION['id'];
            $filename = "uploads/profile" . $id . "*";
            $fileinfo = glob($filename);

            echo "<img class='profilepicture' src=" . $fileinfo[0] . "?'" . mt_rand() . ">";
        } else {
            echo "<img class='profilepicture' src='Photos/FRAJER.png'></img>";
        }
    } else {
        echo "<img class='profilepicture' src='Photos/FRAJER.png'></img>";
    }
    ?>
    <br>
    <b><h2>Změnit profilovku</h2></b>
    <?php
    if (isset($_SESSION['id'])) {

        echo "<form action='includes/uploadRestriction.inc.php' method='post' enctype='multipart/form-data'>
        <input style='color: white;background-color:black;'class='xag' type='file' name='file' required>

        <button class='smallbtn2'  type='submit' name='submit'><b class='svoby'>Potvrdit</b></button>
    </form>";

        if (isset($_SESSION['imgStatus'])) {
            if ($_SESSION['imgStatus'] == 1) {
                echo "<form action='includes/deleteprofile.inc.php' method='post'>
            </form>";
            }
        }

    }
    ?>

    <!--          <button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">Change profile picture</b></a></button>-->
    <hr>
    <b class="reputacehoub">Profil Info</b>
    <br>
    <?php
    if (isset($_SESSION['id'])) {
        echo "<b>Jméno:</b> <b>" . $_SESSION['name'] . "</b><br>";
        echo "<b>Příjmení:</b> <b>" . $_SESSION['surname'] . "</b><br>";
        echo "<b>Třída:</b> <b>" . $_SESSION['class'] . "</b><br>";
        echo "<b>Email:</b> <b>" . $_SESSION['mail'] . "</b><br>";
    }
    ?>


    <button class="smallbtn3"><a class="profilebtn" href="#"><b class="svoby3">Změnit heslo</b>

            <br>
            <button class="smallbtn4"><a class="profilebtn" href="includes/logout.inc.php"><b class="svoby3">Změnit
                        údaje</b></a></button>
            <br>

            <br>
            <br>
            <br>
            <br>

            <hr>

            <?php

            $notification = 0;

            echo "<button class='smallbtn7'><a class='profilebtn' href='myOrders.php'><b class='svoby2'>Moje objednávky<img
                                class='houbiczlobi' src='Photos/cart2.png'></img></b></a>";

            foreach (getProductsByBuyerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        echo "<div class='messageShow'></div>";
                        $notification = 1;
                        break;
                    }
                }
            }
            echo "</button>"
            ?>

            <br>
            <?php
            echo "<button class='smallbtn75'><a class='profilebtn' href='mySells.php'><b class='svoby24'>Moje nabídky<img
                                class='houbiczlobi2' src='Photos/buch2.png'></img></b></a>";

            foreach (getProductsBySellerID($conn, $_SESSION['id']) as $product) {
                foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                    if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                        if($notification == 0){
                            echo "<div class='messageShow'></div>";
                            break;
                        }
                    }
                }
            }
            echo "</button>";
            ?>

            <br>
            <hr>
            <button class="smallbtn5"><a class="profilebtn" href="includes/logout.inc.php"><b class="svoby32">Logout<img
                                class="houbiczlobi3" src="Photos/logout.png"></img></b>
</div>


<?php
include_once 'errorHandler.php';
?>

<?php
include_once 'footer.php';
?>


<style media="screen">
    *,
    *:before,
    *:after {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }


    }

    li {
        font-size: 35px;
    }

    body {
        background-color: white;
        position: relative;
    }

    .houbiczlobi {
        height: 25px;
        margin-left: 10px;
        position: absolute;
    }

    @media (max-width: 900px) {

    }

    .houbiczlobi2 {
        height: 32px;
        margin-top: -5px;
        margin-left: 5px;
        position: absolute;
    }

    .houbiczlobi3 {
        height: 25px;
        margin-top: -5px;
        margin-left: 30px;
        position: absolute;
    }

    .svoby32 {


        margin-left: -50px;

    }

    .svoby3 {

        margin-top: -2.5px;
    }

    .background {

        height: 520px;
        position: absolute;
        transform: translate(-50%, -50%);
        left: 50%;
        top: 50%;
    }

    h2 {
        margin-top: -135px;
        margin-left: 175px;
        position: absolute;
        font-size: 15px;

        font-family: Poppins, sans-serif;
    }

    .svoby {
        transition: 0.2s;
    }

    .svoby2 {
        margin-left: -40px;
    }

    .svoby24 {
        margin-left: -42px;
    }

    .svoby23 {
        font-size: 15px;
        margin-top: -5px;
        margin-left: 0px;
    }

    input {
        margin-top: 1rem;
    }

    input::file-selector-button {
        font-weight: bold;
        color: black;
        padding: 0.5em;
        border: thin solid grey;
        border-radius: 3px;
        background-color: white;
        margin-top: 12px;
        transition: 0.2s;
        cursor: pointer;
    }

    input::file-selector-button:hover {
        opacity: 0.7;
        transition: 0.2s;
    }

    .background .ball {
        height: 200px;
        width: 200px;
        position: absolute;
        border-radius: 50%;
        backdrop-filter: blur(10px);
    }

    .ball:first-child {
        background: linear-gradient(
                green,
                green
        );
        left: 70px;
        top: 20%;
        backdrop-filter: blur(10px);
    }

    .ball:last-child {
        background: linear-gradient(
                to right,
                #00FFFF,
                #00FFFF
        );
        right: -10px;
        bottom: -80px;
        backdrop-filter: blur(10px);
    }

    .profilepicture {
        width: 125px;
        height: 125px;
        justify-content: center;
        display: flex;
        border-radius: 50%;
        transition: 0.2s;
        cursor: pointer;
        border: 2px solid black;
    }

    img.profilepicture {
        border: 2px solid;
    }

    .profilepicture:hover {
        opacity: 0.5;
        transition: 0.2s;
    }

    .mainPartProfile {
        height: 100%;
        width: 400px;
        background-color: rgba(255, 255, 255, 0.13);
        position: relative;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 50%;
        border-radius: 10px;
        margin-top: -50px;
        border: 2px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
        padding: 50px 35px;
    }

    .mainPartProfile * {
        font-family: 'Poppins', sans-serif;
        color: black;
        letter-spacing: 0.5px;
        outline: none;
        border: none;
    }

    .mainPartProfile h3 {
        font-size: 32px;
        font-weight: 600;
        line-height: 42px;
        text-align: center;
    }


    .reputacehoub {
        justify-content: center;
        display: flex;
        font-size: 20px;
    }

    .svoby {
        justify-content: center;
        display: flex;
    }

    label {
        display: block;
        margin-top: 30px;
        font-size: 16px;
        font-weight: 500;
    }

    input {
        display: block;
        height: 50px;
        width: 190px;
        background-color: rgba(255, 255, 255, 0.07);
        border-radius: 3px;
        padding: 0 10px;

        font-size: 12px;
        font-weight: 300;
        position: absolute;
        margin-top: -115px;
        margin-left: 135px;
    }

    ::placeholder {
        color: #e5e5e5;
    }

    button {
        margin-top: 50px;
        width: 100%;
        background-color: #ffffff;
        color: #080710;
        padding: 15px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }


    .smallbtn {
        margin-top: 12px;
        margin-bottom: 12px;
        width: 100%;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 8px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .smallbtn7 {
        margin-top: 12px;
        margin-bottom: 12px;
        width: 225px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 8px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .smallbtn75 {
        margin-top: -20px;
        margin-bottom: 12px;
        width: 195px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 8px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
    }

    .smallbtn2 {
        margin-top: -50px;
        margin-bottom: 12px;
        width: 120px;
        height: 40px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 8px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 170px;
        position: absolute;


    }

    .smallbtn3 {

        margin-top: 20px;
        width: 150px;
        height: 40px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 6px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 0px;

        position: absolute;


    }

    .smallbtn4 {

        margin-top: 2px;
        width: 150px;
        height: 40px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 6px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 155px;

        position: absolute;


    }

    .smallbtn5 {
        justify-content: center;
        display: flex;
        margin-top: 0px;
        width: 150px;
        height: 40px;
        background-color: white;
        border: 5px solid black;
        color: #080710;
        padding: 6px 0;
        font-size: 18px;
        font-weight: 600;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 20%;

        position: absolute;


    }


    .svoby {
        margin-top: -2.5px;

    }

    hr {

        background-color: black;
        height: 5px;
        margin-bottom: 12px;
    }
</style>