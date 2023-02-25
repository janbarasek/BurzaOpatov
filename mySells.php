<?php
include_once 'header.php';
?>

<?php
$userid = $_SESSION['id'];
$products = getProductsBySellerID($conn, $userid);

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
        <h3 style=''>";

    if ($product['buyerid'] == null) {
        echo " None";
    }else{
        echo" ". getUserByID($conn, $product['buyerid'])['name'] ." ". getUserByID($conn, $product['buyerid'])['surname'];
    }

    echo" </h3>
          <br>
            <h3 style=''>";

    if ($product['buyTime'] == null) {
        echo " None";
    }else{
        echo" ". $product['buyTime'];
    }


    echo " </h3>
          <br>
            <h3 style=''>" . getStatusByID($conn, $product['statusid'])['name'] . "</h3>
        <br>
        <input type='number' name='productid' hidden='hidden' value=" . $product['id'] . ">
        
        ";
    if ($product['statusid'] == 1) {
        echo"<button class='alficek2'><a href='includes/MY.inc.php?issue=markassold&id=".$product['id']."'>Mark as sold</a></button>
</div>
  </div>";
    }else if ($product['statusid'] == 2) {
        echo"<button class='alficek2'><a href='includes/MY.inc.php?issue=resell&id=".$product['id']."'>Resell</a></button>
        <button class='alficek2'><a href='includes/MY.inc.php?issue=markassold&id=".$product['id']."'>Mark as sold</a></button>
        <button class='alficek2'><a href='contact.php?id=".$product['id']."'>Contact</a></button>
        </div>
  </div>
        ";
    }else{
        echo"<button class='alficek2'><a href='contact.php?id=".$product['id']."'>Contact</a></button>
</div>
  </div>";
    }

}
?>

<?php
include_once 'footer.php';
?>
