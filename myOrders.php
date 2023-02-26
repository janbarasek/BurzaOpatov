<?php
include_once 'header.php';
?>

<h2>My orders</h2>

<a href="profile.php">Back</a>

<?php
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION['id'];
$products = getProductsByBuyerID($conn, $userid);

foreach ($products as $product){
    $filename = 'Photos/books/' . $product['productslistid'] . '*';
    $fileinfo = glob($filename);
    echo "
<div>
     <img style='' class='image' src='" . $fileinfo[0] . "'></img>
<h3 style=''>" . $product['itemName'] . "</h3>
    <br>
    <div class='booktext'>
        <h3 style=''>" . getRankByID($conn, $product['rankid'])['name'] . "</h3>
        <br>
        <h3 style=''>" . $product['price'] . "</h3>
        <br>
        <h3 style=''>" . getUserByID($conn, $product['userid'])['name'] . " " . getUserByID($conn, $product['userid'])['surname'] . "
        </h3>
          <br>
            <h3 style=''>
            " . $product['buyTime'] . "
</h3>
          <br>
            <h3 style=''>" . getStatusByID($conn, $product['statusid'])['name'] . "</h3>
        <br>
        <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . ">
        
        ";
   if ($product['statusid'] == 2) {
        echo"<button class='alficek2'><a class='black' href='includes/MY.inc.php?issue=markassold&id=".$product['id']."&return=myOrders.php'>Mark as bought</a></button>
        <button class='alficek2'><a  class='black' href='contact.php?id=".$product['id']."&return=myOrders.php'>Contact</a>";

       foreach (getMessagesByProductID($conn, $product['id']) as $message) {
           if ($message['isViewed'] == 0  && $message['recieverid'] == $_SESSION['id']){
               echo "<div class='messageShow'></div>";
               break;
           }
       }
       echo "</button>
        </div>
  </div>
        ";
    }else{
        echo"<button class='alficek2'><a class='black' href='contact.php?id=".$product['id']."&return=myOrders.php'>Contact</a>";

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
