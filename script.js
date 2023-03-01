
// slider
function controlFromInput(fromSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#25daa5', controlSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromSlider.value = from;
    }
}

function controlToInput(toSlider, fromInput, toInput, controlSlider) {
    const [from, to] = getParsed(fromInput, toInput);
    fillSlider(fromInput, toInput, '#C6C6C6', '#25daa5', controlSlider);
    setToggleAccessible(toInput);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
    }
}

function controlFromSlider(fromSlider, toSlider, fromInput) {
    const [from, to] = getParsed(fromSlider, toSlider);
    fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
    if (from > to) {
        fromSlider.value = to;
        fromInput.value = to;
    } else {
        fromInput.value = from;
    }
}

function controlToSlider(fromSlider, toSlider, toInput) {
    const [from, to] = getParsed(fromSlider, toSlider);
    fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
    setToggleAccessible(toSlider);
    if (from <= to) {
        toSlider.value = to;
        toInput.value = to;
    } else {
        toInput.value = from;
        toSlider.value = from;
    }
}

function getParsed(currentFrom, currentTo) {
    const from = parseInt(currentFrom.value, 10);
    const to = parseInt(currentTo.value, 10);
    return [from, to];
}

function fillSlider(from, to, sliderColor, rangeColor, controlSlider) {
    const rangeDistance = to.max-to.min;
    const fromPosition = from.value - to.min;
    const toPosition = to.value - to.min;
    controlSlider.style.background = `linear-gradient(
      to right,
      ${sliderColor} 0%,
      ${sliderColor} ${(fromPosition)/(rangeDistance)*100}%,
      ${rangeColor} ${((fromPosition)/(rangeDistance))*100}%,
      ${rangeColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} ${(toPosition)/(rangeDistance)*100}%, 
      ${sliderColor} 100%)`;
}

function setToggleAccessible(currentTarget) {
    const toSlider = document.querySelector('#toSlider');
    if (Number(currentTarget.value) <= 0 ) {
        toSlider.style.zIndex = 2;
    } else {
        toSlider.style.zIndex = 0;
    }
}

const fromSlider = document.querySelector('#fromSlider');
const toSlider = document.querySelector('#toSlider');
const fromInput = document.querySelector('#fromInput');
const toInput = document.querySelector('#toInput');
fillSlider(fromSlider, toSlider, '#C6C6C6', '#25daa5', toSlider);
setToggleAccessible(toSlider);

fromSlider.oninput = () => controlFromSlider(fromSlider, toSlider, fromInput);
toSlider.oninput = () => controlToSlider(fromSlider, toSlider, toInput);
fromInput.oninput = () => controlFromInput(fromSlider, fromInput, toInput, toSlider);
toInput.oninput = () => controlToInput(toSlider, fromInput, toInput, toSlider);

//generating email

function ShowHideGenerateEmail(){
    if (document.getElementById("generateEmailContainer").style.display == "none")
        document.getElementById("generateEmailContainer").style.display = "block";
    else
        document.getElementById("generateEmailContainer").style.display = "none";
}

function generateEmail(name, surname, nameSeller, nameItem) {
    var email = document.getElementById("email").value;
    var date = document.getElementById("date").value;
    var time = document.getElementById("time").value;
    var place = document.getElementById("place").value;



    var emailBody = "Ahoj " + nameSeller + ". \n"
    + "Mám zájem o nákup knihy: " + nameItem +". \n"
    + "Můžeme se sejít v " + GetPlaceByid(place) + " v " + GetTimeByid(time) + " dne " + GetDate(date) + ". \n"
    + "Díky moc. \n"
    + name + " " + surname;

    ShowEmail(emailBody);

}

function GetPlaceByid(id) {
    dict = {
        "1": "satny",
        "2": "Pavilon A",
    }

    if(dict[id] == undefined)
        return "[vlozte misto]";
    return dict[id];
}

function GetTimeByid(id){
    dict = {
        "1": "7:40",
        "2": "8:45",
        "3": "9:40",
        "4": "10:40",
        "5": "11:40",
        "6": "12:35",
        "7": "13:30",
        "8": "14:25",
        "9": "15:20",
        "10": "16:10",
        "11": "17:00",
    }

    if(dict[id] == undefined)
        return "[vlozte cas]";
    return dict[id];
}

function GetDate(date){
    if(date == "")
        return "[vlozte datum]";
    return date;
}

function ShowEmail(email){
    document.getElementById("email").value = email;
}