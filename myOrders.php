<?php
include_once 'header.php';
?>

<div id='objednavky' class='objednavky'>
    <div id='title-div' class='title-div'>
        <h1 id='title-text' class='title-text'>Moje objednávky</h1>
    </div>

    <!--<a href="profile.php">Back</a>-->

    <?php
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit();
    }

    $userid = $_SESSION['id'];
    $products = getProductsByBuyerID($conn, $userid);

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
                </div>
                <p class='owner'>" . getUserByID($conn, $product['userid'])['name'] . " " . getUserByID($conn, $product['userid'])['surname'] . "</p>
                <p class='reservation'>" . getStatusByID($conn, $product['statusid'])['name'] . "<br></p>   
                <div class='price-grid'>
                    <p class='price'>" . $product['price'] . " Kč</p>
                </div>
            </div>
        </div>

        <div class='buttons-div'>

        
        ";
        if ($product['statusid'] == 2) {
            echo "<button class='kontakt-button'><a  class='kontakt-button-text' href='contact.php?id=" . $product['id'] . "&return=myOrders.php'>Kontakt";

            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']) {
                    echo "<i class='material-icons' style='font-size: 3vw;'>sms_failed</i>"; ##oznameni ze prisla zprava
                    break;
                }
            }


            echo "</a></button>
        <button class='cancel-button'><a href='includes/MY.inc.php?issue=markassold&id=".$product['id']."&return=myOrders.php' class='cancel-button-text' >Označit jako zakoupené</a></button>
        ";

}


            foreach (getMessagesByProductID($conn, $product['id']) as $message) {
                $notification = 0;
                if ($message['isViewed'] == 0 && $message['recieverid'] == $_SESSION['id']  && $notification == 0) {
                    echo "<div class='messageShow'></div>";
                    $notification = 1;
                    break;
                }
            }
            echo "
</div>
  </div>";

    }
    ?>
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
    </style>
    <?php
    include_once 'footer.php';
    ?>
