<?php
include_once 'header.php';
?>


<?php
if (isset($_SESSION["name"])){
    echo "<p style='color: red;margin-top:-25px;font-family:Poppins,sans-serif;justify-content:center;display:flex;text-align:center;font-weight:600;font-size:30px;background-color:black;'> Hello " . $_SESSION["name"] . " and welcome to BURZA OPATOV!</p>";
}
?>


<?php
    include_once 'footer.php';
?>