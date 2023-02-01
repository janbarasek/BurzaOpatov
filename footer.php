<?php

//Debugging
if(isset($_SESSION["id"])){
    echo '<p> You are logged in!</p>';
}
else{
    echo '<p> You are logged out!</p>';
}

print_r($_SESSION);
?>

</body>