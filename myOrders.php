<?php
include_once 'header.php';
?>

<div id='objednavky' class='objednavky'>
        <div id='title-div' class='title-div'>
            <h1 id='title-text' class='title-text'>Moje objednávky</h1>
        </div>

<a href="profile.php">Back</a>

<?php
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['id'];
$products = getProductsByBuyerID($conn, $userid);

foreach ($products as $product){
    $filename = 'Photos/books/'.$product['productslistid'].'*';
    $fileinfo = glob($filename);
    echo "
    <div class='item-div'>
        <div class='item-grid'>
            <div class='img-div'>
                <img src='" . $fileinfo[0] . "' class='img' width='75%'>
            </div>

            <div class='item-text'>
                <div class='name-grid'>
                    <h1 class='name'>" . $product['itemName'] . " - " . getRankByID($conn, $product['rankid'])['name'] . "</h1>
                </div>
                <p class='owner'>" . getUserByID($conn, $product['userid'])['name'] . " " . getUserByID($conn, $product['userid'])['surname'] . "</p>
                <p class='reservation'>" . getStatusByID($conn, $product['statusid'])['name'] . "<br>-&gt; <!--chybí datum a místo předáni--></p>   
                <div class='price-grid'>
                    <p class='price'>" . $product['price'] . " Kč</p>
                </div>
            </div>
        </div>

        <div class='buttons-div'>
                
   <!--      
            <h3 style=''>
            " . date("d-m-Y", strtotime($product['buyTime']))  . "
</h3> ##datum objednání k nicemu
        <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . "> ##co tohle sakra dělá?!
        -->

        ";
   if ($product['statusid'] == 2) {
        echo"<button class='kontakt-button'><a  class='kontakt-button-text' href='contact.php?id=".$product['id']."&return=myOrders.php'>Kontakt <i class='material-icons' style='font-size: 3vw;'>chat_bubble_outline</i>";

       foreach (getMessagesByProductID($conn, $product['id']) as $message) {
           if ($message['isViewed'] == 0  && $message['recieverid'] == $_SESSION['id']){
               echo "<i class='material-icons' style='font-size: 3vw;'>sms_failed</i>"; ##oznameni ze prisla zprava
               break;
           }
       }
        echo "</a></button>
        <button class='cancel-button'><a class='cancel-button-text' >Zrušit rezervaci</a></button>
    </div>
</div>
        ";
    }else{
        echo"<i class='material-icons' style='font-size: 3vw;'>chat_bubble_outline</i></a></button>
        <button class='cancel-button'><a class='cancel-button-text' >Zrušit rezervaci</a></button>
    </div>
</div>";

##link to cancel product - href='includes/MY.inc.php?issue=markassold&id=".$product['id']."&return=myOrders.php'

       foreach (getMessagesByProductID($conn, $product['id']) as $message) {
           if ($message['isViewed'] == 0  && $message['recieverid'] == $_SESSION['id']){
               echo "<div class='messageShow'></div>";
               break;
           }
       }
       echo "</button>
</div>
  </div>";
    }

}
?>

<?php
include_once 'footer.php';
?>
