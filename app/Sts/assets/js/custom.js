if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

document.querySelector('#menu-btn').addEventListener('click', function() {
    //console.log("Menu");

    document.querySelector('#menu-site').classList.toggle("active");
    document.querySelector('#menu-icon').classList.toggle("active");
});