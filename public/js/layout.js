(function() {
    let user = document.querySelector(".user");
    let userMenu = document.querySelector(".user-menu");

    menuShow = function() {
        userMenu.classList.remove("hidden");
        user.style.backgroundColor = "rgb(35, 35, 95)";
    }

    menuHide = function() {
        userMenu.classList.add("hidden");
        user.style.backgroundColor = "rgb(7, 7, 61)";
    }

    user.addEventListener("mouseover", menuShow);
    userMenu.addEventListener("mouseover", menuShow);
    user.addEventListener("mouseout", menuHide);
    userMenu.addEventListener("mouseout", menuHide);
})()