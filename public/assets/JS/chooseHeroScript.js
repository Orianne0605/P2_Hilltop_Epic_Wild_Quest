let width = window.screen.width;
console.log(width);

const cardWarrior = document.getElementById("card-warrior");
const statsWarrior = document.getElementById("stats-warrior");
const warriorBtn = document.getElementById("warrior-btn");
const cardMage = document.getElementById("card-mage");
const statsMage = document.getElementById("stats-mage");
const mageBtn = document.getElementById("mage-btn");
const cardRogue = document.getElementById("card-rogue");
const statsRogue = document.getElementById("stats-rogue");
const rogueBtn = document.getElementById("rogue-btn");

if (width <= 640) {
    //warrior
    cardWarrior.addEventListener("click", displayHero);
    function displayHero()
    {
        //warrior display
        cardWarrior.classList.toggle("displayWarrior");
        statsWarrior.classList.toggle("displayWarrior");
        warriorBtn.classList.toggle("displayWarrior");
        //mage reset
        cardMage.classList.remove("displayMage");
        statsMage.classList.remove("displayMage");
        mageBtn.classList.remove("displayMage");
        //rogue reset
        cardRogue.classList.remove("displayRogue");
        statsRogue.classList.remove("displayRogue");
        rogueBtn.classList.remove("displayRogue");
    }

    // mage
    cardMage.addEventListener("click", displayMage);
    function displayMage()
    {
        //mage display
        cardMage.classList.toggle("displayMage");
        statsMage.classList.toggle("displayMage");
        mageBtn.classList.toggle("displayMage");
        //rogue reset
        cardRogue.classList.remove("displayRogue");
        statsRogue.classList.remove("displayRogue");
        rogueBtn.classList.remove("displayRogue");
        //warrior reset
        cardWarrior.classList.remove("displayWarrior");
        statsWarrior.classList.remove("displayWarrior");
        warriorBtn.classList.remove("displayWarrior");
    }

    // rogue
    cardRogue.addEventListener("click", displayRogue);
    function displayRogue()
    {
        //rogue display
        cardRogue.classList.toggle("displayRogue");
        statsRogue.classList.toggle("displayRogue");
        rogueBtn.classList.toggle("displayRogue");
        //warrior reset
        cardWarrior.classList.remove("displayWarrior");
        statsWarrior.classList.remove("displayWarrior");
        warriorBtn.classList.remove("displayWarrior");
        //mage reset
        cardMage.classList.remove("displayMage");
        statsMage.classList.remove("displayMage");
        mageBtn.classList.remove("displayMage");
    }
}
