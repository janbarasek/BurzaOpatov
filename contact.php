<?php
include_once 'header.php';
?>

<?php

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

if (getProductsByID($conn, $_GET['id'])[0]['userid'] == $_SESSION['id'] || getProductsByID($conn, $_GET['id'])[0]['buyerid'] == $_SESSION['id']) {
    $messages = getMessageByProductID($conn, $_GET['id']);

    echo "<div class='messagecontainer'>";

    foreach ($messages as $message) {
        echo "<div class='message";
        if ($message['userid'] == $_SESSION['id']) {
            echo " messageRight";
        }else{
            echo " messageLeft";
        }
        echo "'>
        <p class='messageUser'>" . getUserByID($conn, $message['userid'])['name'] . " " . getUserByID($conn, $message['userid'])['surname'] . "</p>
            <div class='messageText'>
            <p>" . $message['message'] . "</p>
            </div>
        </div>";
    }

    echo "</div>";

    echo "<form action='includes/MY.inc.php' method='get'>
    <input type='number' name='productid' hidden='hidden' value=" . $_GET['id'] . ">
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
