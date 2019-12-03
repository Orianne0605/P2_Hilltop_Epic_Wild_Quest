//DISPLAY INVENTORY RESPONSIVE
const bagIcon = document.getElementById("bagIcon");
const main = document.getElementById("main");
const history = document.getElementById("history");
const responses = document.getElementById("responses");
const enigma = document.getElementById("enigma");
const displayBag = document.getElementById("bagScript");
const combat = document.getElementById("combat");

if (history !== null) {
    bagIcon.addEventListener("click", bagScript);
    function bagScript()
    {
            displayBag.classList.toggle("script");
            history.classList.toggle("script");
            responses.classList.toggle("script");
            main.classList.toggle("script");
    }
}

if (enigma !==null) {
    bagIcon.addEventListener("click", bagScriptEnigma);
    function bagScriptEnigma()
    {
        displayBag.classList.toggle("script");
        enigma.classList.toggle("script");
        main.classList.toggle("script");
    }
}

if (combat !==null) {
    bagIcon.addEventListener("click", bagScriptCombat);
    function bagScriptCombat()
    {
        displayBag.classList.toggle("script");
        combat.classList.toggle("script");
        main.classList.toggle("script");
    }
}