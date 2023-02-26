<?php
include_once 'header.php';
?>

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
        <p class='messageUser'>" . getUserByID($conn, $message['userid'])['name'] . " " . getUserByID($conn, $message['userid'])['surname'] . "</p>
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
    <input type='text' name='message' placeholder='Message'>
    <button type='submit' name='submitmessage'>Send</button>
    </form>";
} else {
    header("Location: index.php");
    exit();
}


?>


<?php
include_once 'footer.php';
?>
