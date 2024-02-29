/* ====================================================================================================================
================================   PRE-LOADER   ================================================================
==================================================================================================================== */
const main = document.getElementById('SECTIONS')
const preloader = document.getElementById('pre_loader')

window.addEventListener("load", function() {
    preloader.classList.add("hidden");
    main.classList.remove("hidden");
})
/* ====================================================================================================================
  ================================   LIGHT | DARK MODE   ==============================================================
  ==================================================================================================================== */

/*============================== Light|Dark Mode Toggle =====================================*/
const LightDarkToggle = document.querySelector(".DL_ICON");
const DAY_NIGHT = document.querySelector(".DAY_NIGHT");

var DARK_MODE;

if(localStorage.getItem('DARK_MODE')){
    DARK_MODE = localStorage.getItem('DARK_MODE');
}
else
{
    DARK_MODE = 'LIGHT';
}

localStorage.setItem('DARK_MODE', DARK_MODE);

if(localStorage.getItem('DARK_MODE') == 'DARK')
{
    document.body.classList.add("DARK")

    DAY_NIGHT.querySelector("i").classList.remove("fa-moon");
        
    DAY_NIGHT.querySelector("i").classList.add("fa-sun");
}


LightDarkToggle.addEventListener("click", () => {
    document.querySelector("body").classList.toggle("DARK");
    if(document.body.classList.contains("DARK"))
    {
        DAY_NIGHT.querySelector("i").classList.remove("fa-moon");
        
        DAY_NIGHT.querySelector("i").classList.add("fa-sun");

        localStorage.setItem('DARK_MODE','DARK');
    }
    else
    {
        DAY_NIGHT.querySelector("i").classList.remove("fa-sun");
        
        DAY_NIGHT.querySelector("i").classList.add("fa-moon");

        localStorage.setItem('DARK_MODE','LIGHT');
    }
})
/* ====================================================================================================================
================================   PROFILE PIC BUTTON ||| RESUSABLE CODE   ================================================================
==================================================================================================================== */
function toggleDropdown() {
    var dropdown = document.getElementById("dropdownMenu");
    dropdown.style.display = dropdown.style.display === "none" ? "block" : "none";
  }
/* ====================================================================================================================
================================   FILE INPUT BUTTON ||| RESUSABLE CODE   ================================================================
==================================================================================================================== */
// JavaScript Functionality for file input
document.getElementById("userProfile").addEventListener("change", function () {
  var fileName = this.files[0].name;
  var inputField = this.parentElement.querySelector('input[type="text"]');
  inputField.value = fileName;
});
/* ====================================================================================================================
  ================================   DROP DOWN MENU IN PROFILE.PHP   ==============================================================
  ==================================================================================================================== */
  //function toggleDropdown2() {
    //var dropdownMenu = document.getElementById("dropdownMenu");
    //dropdownMenu.classList.toggle("show");
//}