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
    } else if ($_GET["error"] == "wrongfiletype"){
        echo "<p class='error'>Špatný typ souboru!</p>";
    } else if ($_GET["error"] == "invalidname"){
        echo "<p class='error'>Neplatné jméno</p>";
    } else if ($_GET["error"] == "invalidsurname"){
        echo "<p class='error'>Neplatné příjmení</p>";
    } else if ($_GET["error"] == "invalidemail"){
        echo "<p class='error'>Neplatný email</p>";
    } else if ($_GET["error"] == "passwordsdontmatch"){
        echo "<p class='error'>Hesla se neshodují</p>";
    } else if ($_GET["error"] == "emailtaken"){
        echo "<p class='error'>Email je již používán</p>";
    } else if ($_GET["error"] == "emptyclassoremail"){
        echo "<p class='error'>Vyberte třídu nebo email</p>";
    } else if ($_GET["error"] == "none"){
        echo "<p class='success'>Vše proběhlo v pořádku!</p>";
    }
}
?>