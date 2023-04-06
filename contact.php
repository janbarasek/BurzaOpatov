<?php
include_once 'header.php';
?>
  
  <h3 style='float: right;font-weight:600;font-size: 20px;margin-right:5%;margin-top:0px;color:black;'>biologie pro gymnázia</h3>
<hr style='padding:1px;margin-top:52px;margin-left:100px;width: 100px;background-color:black;'>
<h3 style='font-size:18px;margin-left:210px;'>Info</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 135px;background-color:black;'>
 <img style='float:left;margin-left:0px;
  width: 100px;margin-top:-70px;'class='image' src='Photos/books/1.png'></img>
  <h3 style='margin-top:0px;font-size:15px;margin-left:110px;color:gray;'></h3>
        <br>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-40px;margin-left:110px;color:gray;'>Cena - 999Kč</h3>
        <br>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-21px;margin-left:110px;color:gray;;'>Mírně použitá</h3>
        <br>
        <br>
        <h3 style='color:black;font-size:15px;margin-top:-20px;margin-left:110px;color:gray;'>Pejtrik Frája</h3>

<hr style='padding:1px;margin-top:10px;margin-left:0px;width: 200px;background-color:black;'>
<h3 style='font-size:18px;margin-left:210px;'>Chat</h3>
<hr style='padding:1px;margin-top:-12px;float:right;width: 120px;background-color:black;'>
<?php

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (getProductByID($conn, $_GET['id'])['userid'] == $_SESSION['id'] || getProductByID($conn, $_GET['id'])['buyerid'] == $_SESSION['id']) {
    $messages = getMessagesByProductID($conn, $_GET['id']);

    echo "
<div class='backBut'>
<a href='".$_GET['return']."'> Back </a>
</div>";

    mysqli_query($conn, "UPDATE message SET isViewed = 1 WHERE productid = '" . $_GET['id'] . "' AND recieverid = '" . $_SESSION['id'] . "'");


    echo "<div class='messagecontainer'>";

    foreach ($messages as $message) {
        if ($message['isVisible'] == 1) {
            echo "<div class='message";
            if ($message['userid'] == $_SESSION['id']) {
                echo " messageRight";
            } else {
                echo " messageLeft";
            }
            echo "'>
        <p style=''class='messageUser'>" . getUserByID($conn, $message['userid'])['name'] . " " . getUserByID($conn, $message['userid'])['surname'] . "</p>
            <div class='messageText'>
            <p>" . $message['message'] . "</p>
            </div>
        </div>";


            echo "</div>";

        }
    }

    echo "<form action='includes/MY.inc.php' method='get'>
    <input type='number' name='productid' hidden='hidden' value=" . $_GET['id'] . ">
    <input type='text' name='return' hidden='hidden' value=" . $_GET['return'] . ">
    <input type='text' name='message' style='border: 1px solid black;
    box-shadow: 2px 2px #888888;background-color:gray;color:black;width:94%;margin-left:10px;' placeholder='Message'>
    <button class='submitbuttones' style='margin-top:-42px;height:0px;float:right;margin-right:40px;width:40px;border:0px solid white;background-color:gray;'type='submit' name='submitmessage'><img style='margin-top:-15px;float:right;margin-right:-20px;width:40px;' src='vlastovka.png' type='submit' name='submitmessage'></img></button>
    </form>";

    include_once 'errorHandler.php';
} else {
    header("Location: index.php");
    exit();
}


?>
<style>

.messageUser {
    font-weight: bold;
    font-size: 15px;
    margin-right: 10px;
   

}
.messageText {
    background-color: white;
    border-radius: 5px;
    border: 1px solid black;
    box-shadow: 2px 2px #888888;
    padding: 10px;
    margin: 10px;
    width: 80%;
    float: right;
  
   
    clear: both;
}

. {
    background-color: black;
    border-radius: 5px;
    border: 1px solid gray;
    box-shadow: -2px 2px gray;
    padding: 10px;
    margin: 10px;
    width: 80%;
    float: left;
    clear: both;
    color: white;
}
</style>

<?php
include_once 'footer.php';
?>
