<?php
include_once 'header.php';
?>

<div id='objednavky' class='objednavky'>
    <div id='title-div' class='title-div'>
        <h1 id='title-text' class='title-text'>Moje inzeráty</h1>
    </div>

    <?php

    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION['id'];
    $products = getProductsBySellerID($conn, $userid);

    include_once 'errorHandler.php';

    foreach ($products as $product) {
        $filename = 'Photos/books/' . $product['productslistid'] . '*';
        $fileinfo = glob($filename);
        echo "
    
    <div class='item-div'>
        <div class='item-grid'>
            <div class='img-div'>
                <img src='" . $fileinfo[0] . "' class='img' width='75%'>
            </div>

            <div class='item-text'>
                <div class='name-grid'>
                    <h2 class='name'>" . $product['itemName'] . "<br>" . getRankByID($conn, $product['rankid'])['name'] . "</h2>
                     <a href='includes/MY.inc.php?issue='><img src='Photos/dust-bin.png' width='60%' class='img-bin'></a>
                </div>
                ";

        if ($product['buyerid'] == null) {
            echo "<p class='owner'>Nerezervováno</p>";
        } else {
            echo "<p class='owner'>" . getUserByID($conn, $product['buyerid'])['name'] . " " . getUserByID($conn, $product['buyerid'])['surname'] . "</p>";
        }
        echo "
                <p class='reservation'>" . getStatusByID($conn, $product['statusid'])['name'] . "<br></p>   
                <div class='price-grid'>
                    <p class='price'>" . $product['price'] . " Kč</p>";
        if ($product['statusid'] == 2) {
            echo "<button class='sells-cancel-button'><a class='sells-cancel-button-text' href='includes/MY.inc.php?issue=resell&id=" . $product['id'] . "&return=mySells.php'>Zrušit rezervaci</a></button>";
        }
        echo "
                </div>
            </div>
        </div>

        <div class='buttons-div'> ";
        if ($product['statusid'] == 2) {
            echo "<button class='kontakt-button'><a  class='kontakt-button-text' href='contact.php?id=" . $product['id'] . "&return=myOrders.php'>Kontakt";

            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                    echo "<i class='material-icons' style='font-size: 3vw;'>sms_failed</i>";
                    break;
                }
            }
            echo "</a></button>";
        } else {
            echo "<p></p>";
        }
        echo "<button class='cancel-button'><a class='cancel-button-text' href='includes/MY.inc.php?issue=markassold&id=" . $product['id'] . "&return=mySells.php'>Prodáno</a></button>
    </div>
</div>";
    }
    echo "<div id='add-item' class='add-item'><a href='sell.php'>
<button id='add-item-btn' class='add-item-btn'><p>+</p></button></a>
</div>"
    ?>

</div>
    <style>
        body {
            font-family: Kanit-Light;
            margin: 0;
            background-color: black;
        }

        .menu-container {
            margin: 0;
        }

        *, *:before, *:after {
            box-sizing: content-box;
        }

        button {
            line-height: 1;
            display: inline-block;
        }



        img {
            width: 75%;
        }

        button:hover {
            background: rgb(53, 51, 51);
            color: white;
        }
    </style>
    <?php
    include_once 'footer.php';
    ?>
