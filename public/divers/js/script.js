function openNav() {
    document.getElementById("sideNav").style.width = "250px";
}

function closeNav() {
    document.getElementById("sideNav").style.width = "0";
}

document.querySelector('.navbar-toggler').addEventListener('click', function() {
    openNav();
});