let hamburger = document.getElementsByClassName('hamburger')[0];
let menus = document.getElementsByClassName('menus')[0];
hamburger.addEventListener("click",function (){
    console.log(hamburger);
    console.log(menus);
    menus.classList.toggle("show");
});