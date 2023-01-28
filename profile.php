<?php
include_once 'header.php'
?>
<h1>Profile page</h1>

<?php
if (isset($_SESSION['id'])) {
    echo "<p> Hello " . $_SESSION['id'] . "!</p>";
}
?>

<?php
include_once 'footer.php'
?>