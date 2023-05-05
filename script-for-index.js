
const vzor = document.getElementById("vzor").content
const stranka = document.getElementById("storage-box")
const vyhledavani = document.getElementById("vyhledavani")
const minPrice = document.getElementById("min-price")
const maxPrice = document.getElementById("max-price")
var min = 1;
var max = 999;

function priceSearch(book) {
  if (book.price > max || book.price < min) {
    if (!book.id.classList.contains("hide")) {
    book.id.classList.toggle("hide")
    }
  } else if (book.id.classList.contains("hide")) {
    book.id.classList.toggle("hide")
  }
}

let users = []
minPrice.addEventListener("input", e => {
  min = Number(e.target.value)
  mylist.forEach(priceSearch)
})
maxPrice.addEventListener("input", e => {
  max = Number(e.target.value)
  mylist.forEach(priceSearch)
})

vyhledavani.addEventListener("input", e => {
  if (topic == 'Předmět') {
    const value = e.target.value.toLowerCase()

    mylist.forEach(book => {
      const isVisible =
        book.book.toLowerCase().includes(value)
      book.id.classList.toggle("hide", !isVisible)
    })
  } else if (topic == 'Stav') {
    const value = e.target.value.toLowerCase()

    mylist.forEach(book => {
      const isVisible =
        book.state.toLowerCase().includes(value)
      book.id.classList.toggle("hide", !isVisible)
    })
  } else if (topic == 'Majitel') {
    const value = e.target.value.toLowerCase()

    mylist.forEach(book => {
      const isVisible =
        book.owner.toLowerCase().includes(value)
      book.id.classList.toggle("hide", !isVisible)
    })
  }
})
//---------------------------------------------------------------------------------
function showDropdown() {
  document.getElementById("dropdown").classList.toggle("hide")
}
var topic = "predmet"
function changeTopic(top) {
  document.getElementById("showDropdown").innerHTML = top;
  document.getElementById("dropdown").classList.toggle("hide")
  
  if (top == 'Cena' && topic != 'Cena' || top != 'Cena' && topic == 'Cena') {
    document.getElementById("div-srch").classList.toggle("hide")
    document.getElementById("div-price").classList.toggle("hide")
  }
  topic = top
  console.log(topic)
}
//---------------------------------------------------------------------------------
var count = 0;
const xmlhttp = new XMLHttpRequest();
var mylist

xmlhttp.onload = function() {
  console.log(this.responseText)
  mylist = JSON.parse(this.responseText);
  mylist.forEach(json)
}
xmlhttp.open("GET", "jsonSender.php");
xmlhttp.send();

function json(book) {
  book.price = Number(book.price)
  console.log("makam")
  const kniha = document.importNode(vzor,true);
  book.owner = book.name + " " + book.surname
  kniha.querySelector("#owner").textContent = book.owner;
  kniha.querySelector("#book-name").textContent = book.book + " - " + book.state;
  kniha.querySelector("#date").textContent = "Přidáno " + book.date;
  kniha.querySelector("#price").textContent = book.price + " kč";
  kniha.querySelector("#image").src = book.image + ".png"; //WIP
 // kniha.querySelector("#link").href = book.link; NOTWORK
  stranka.appendChild(kniha);

document.getElementById("b").id = String(count);
book.id = document.getElementById(String(count));
  count++
  console.log(book)
}