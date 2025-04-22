document.addEventListener("DOMContentLoaded", function () {
    const burgerIcon = document.querySelector(".burger-icon");
    const navBar = document.getElementById("navBar");
    const menuNosLocations = document.querySelector("#menuNosLocations");
    const sousMenu = document.querySelector(".sous-menu");

    burgerIcon.addEventListener("click", function () {
        navBar.classList.toggle("active");
    });
    if (menuNosLocations) {
        menuNosLocations.addEventListener("click", function (event) {
            const linkClicked = event.target;
            if (linkClicked && linkClicked.classList.contains('lienMenu')) {
                return;
            }
            event.preventDefault();

            if (sousMenu.style.display === "block") {
                sousMenu.style.display = "none";
            } else {
                sousMenu.style.display = "block";
            }
        });
    }
});
