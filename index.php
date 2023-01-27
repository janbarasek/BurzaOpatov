<?php
    include_once 'header.php';
?>

<?php
if (isset($_SESSION["useruid"])){
    echo "<p> Hello " . $_SESSION["useruid"] . "!</p>";
}
?>
<p>
    This is the index page.
</p>

<?php
    include_once 'footer.php';
?>