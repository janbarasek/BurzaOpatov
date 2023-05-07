
<?php
  include_once 'header.php';
?>
  <div class="srch-cont">
    <div class="drop-div dropdown">
      <button id="showDropdown" onclick="showDropdown()" class="dropbtn">Předmět</button>
      <div id="dropdown" class="dropdown-content hide">
        <a onclick="changeTopic('Předmět')">Předmět</a>
        <a onclick="changeTopic('Stav')">Stav</a>
        <a onclick="changeTopic('Majitel')">Majitel</a>
        <a onclick="changeTopic('Cena')">Cena</a>
      </div>
    </div>
    <div id="div-srch" class="div-srch">
      <input class="srch" type="text" id="vyhledavani" placeholder="hledat kiny">
    </div>
    <div id="div-price" class="div-price hide">
      <div class="srch-pr-input">min<input class="min-price" type="number" id="min-price" value="1" min="1" max="999"></div>
      <div class="srch-pr-input">max</label><input class="max-price" type="number" id="max-price" value="999" min="1" max="999"></div>
    </div>
    <button class="srch-settings" onclick="settings()">Text</button>
  </div>
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

  <script src="script-for-index.js"></script>
<style>
  body {
    font-family: Kanit-Light;
    margin: 0;
    background-color: black;
  }
  

  img {
    width: 75%;
  }
</style>

<?php
  include_once 'footer.php';
?>