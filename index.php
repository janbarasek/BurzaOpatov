<?php
    include_once 'header.php';
?>

<?php
if (isset($_SESSION["id"])){
    echo "<p> Hello " . $_SESSION["id"] . "!</p>";
}
?>
<p>
    This is the index page.
</p>

<?php
    if(isset($_SESSION["id"])){
        echo "<p> You are logged in!</p>";
    }
    else{
        echo "<p> You are logged out!</p>";
    }

    print_r($_SESSION);
?>

<?php
    include_once 'footer.php';
?>