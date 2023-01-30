<?php
include_once 'header.php';
?>

<br>
<br>
<br>

<div class="buttons">
  <b><a class="ej">PRODEJ</a></b>
   <b><a class="bi">KVARTA</a></b>
  </div> 
<br>
<br>
   <div class="buttons">
  <b><a class="ej">KVINTA</a></b>
   <b><a class="bi">SEXTA</a></b>
  </div>  
<br>
<br>
<div class="buttons">
  <b><a class="ej">SEPTIMA</a></b>
   <b><a class="bi">OKTÁVA</a></b>
  </div> 
  <br>
  <br>
<div class="buttons">
  <b><a class="ej">PROFILE</a></b>
   <b><a class="bi">TOPS</a></b>
  </div> 

  <br>
  <br>
  <br>
  <br>
  <br>

</body>
</html>


<?php
if (isset($_SESSION["id"])){
    echo "<p> Hello " . $_SESSION["id"] . "!</p>";
}
?>
<p>
    This is the index page.
</p>



<?php
    include_once 'footer.php';
?>