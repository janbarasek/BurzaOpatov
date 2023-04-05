<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo "<p class='error'>Vyplňte všechna pole!</p>";
    } else if ($_GET["error"] == "wronglogin") {
        echo "<p class='error'>Špatné přihlašovací údaje</p>";
    } else if ($_GET["error"] == "bookalreadybought"){
        echo "<p class='error'>Někdo si tuto knihu koupil před vámi!</p>";
    } else if ($_GET["error"] == "yourbook"){
        echo "<p class='error'>Nemůžete si koupit vlastní knihu!</p>";
    } else if ($_GET["error"] == "price"){
        echo "<p class='error'>Neplatná cena!</p>";
    } else if ($_GET["error"] == "stmtfailed"){
        echo "<p class='error'>Něco se pokazilo!</p>";
    } else if ($_GET["error"] == "spam"){
        echo "<p class='error'>Zpráva byla odeslána příliš rychle, opakujte za chvíli znovu</p>";
    } else if ($_GET["error"] == "none"){
        echo "<p class='error'>Vše proběhlo v pořádku!</p>";
    }
}
?>