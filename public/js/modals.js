const modals = document.querySelectorAll(".modal");
const openModalButtons = document.querySelectorAll(".openModalBtn");
const closeModalButtons = document.querySelectorAll(".close");

openModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        const modal = button.nextElementSibling;
        modal.style.display = "block";
    });
});

closeModalButtons.forEach(button => {
    button.addEventListener("click", function () {
        const modal = button.closest(".modal");
        modal.style.display = "none";
    });
});

window.addEventListener("click", function (event) {
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
});
