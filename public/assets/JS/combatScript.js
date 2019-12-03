const weaponsDisplayer = document.getElementById("weaponsDisplayer");
const itemsDisplayer = document.getElementById("itemsDisplayer");
const displayWeapons = document.getElementById("displayedWeapons");
const displayItems = document.getElementById("displayedItems");

// Displays the weapon list
document.getElementById("weaponsDisplayer").addEventListener("click", displayedWeapons);
function displayedWeapons()
{
        displayWeapons.classList.toggle("script");
        itemsDisplayer.classList.toggle("displayN");
}

//Displays the item list
document.getElementById("itemsDisplayer").addEventListener("click", displayedItems);
function displayedItems()
{
        displayItems.classList.toggle("displayB");
        weaponsDisplayer.classList.toggle("displayN");
}
