
<?php
  include_once 'header.php';
?>
<script src="script-for-index"></script>
  <div class="srch-cont">
    <div class="drop-div">
     <button id="showDropdown"  class="showdrop" onclick="showDropdown()">Předmět</button>
      <div id="dropdown" class="dropdown hide">
        <button id="predmet" class="drop-btn" onclick="changeTopic('Předmět')">Předmět</button>
        <button id="stav" class="drop-btn" onclick="changeTopic('Stav')">Stav</button>
        <button id="majitel" class="drop-btn" onclick="changeTopic('Majitel')">Majitel</button>
        <button id="cena" class="drop-btn" onclick="changeTopic('Cena')">Cena</button>
      </div>
    </div>
    <div id="div-srch" class="div-srch">
      <input class="srch" type="text" id="vyhledavani" placeholder="hledat kiny">
    </div>
    <div id="div-price" class="div-price hide">
      <label for="min-price">min</label><input class="min-price" type="number" id="min-price" value="1" min="1" max="999">
      <label for="max-price">max</label><input class="max-price" type="number" id="max-price" value="999" min="1" max="999">
    </div>
    <button class="srch-settings" onclick="settings()">Text</button>
  </div>
  <div class="u-srch"></div>
  <div class="objednavky">
    <template id="vzor">
    <div class="item-div" id="b">
      <div class="item-grid">
          <div class="img-div">
              <img id="image" src="" class="img" width="75%">
          </div>
  
          <div class="item-text">
              <div class="name-grid">
                  <h1 id="book-name" class="name"></h1>
                  
              </div>
              <p id="owner" class="owner" style="font-size: 3vw;"></p>
              <p id="date" class="reservation" style="font-size: 3vw;"></p>
              <div class="price-grid">
                  <p id="price" class="price">999 Kč</p>
              </div>
          </div>
      </div>
    </template>
    <div id="storage-box"> </div>
  </div>

<<<<<<< HEAD
<style>
  body {
    font-family: Kanit-Light;
    margin: 0;
    background-color: black;
  }
  *, *:before, *:after {
    box-sizing: content-box;
        }

  button {
    line-height: 1;
    display: inline-block;
  }

  img {
    width: 75%;
  }
</style>

<?php
  include_once 'footer.php';
?>