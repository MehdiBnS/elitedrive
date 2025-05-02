document.addEventListener("DOMContentLoaded", () => {
    const modalUpdateUser = document.querySelector(".modalUpdateUser");
    const closeUpdateUserBtn = document.querySelector(".closeUpdateUser");

    function openUpdateUserModal(utilisateur) {
        modalUpdateUser.style.display = "flex";

        modalUpdateUser.querySelector("#id_utilisateur").value = utilisateur.id_utilisateur || "";
        modalUpdateUser.querySelector("#nom").value = utilisateur.nom || "";
        modalUpdateUser.querySelector("#prenom").value = utilisateur.prenom || "";
        modalUpdateUser.querySelector("#email").value = utilisateur.email || "";
        modalUpdateUser.querySelector("#numero_telephone").value = utilisateur.numero_telephone || "";
        modalUpdateUser.querySelector("#ville").value = utilisateur.ville || "";
        modalUpdateUser.querySelector("#role").value = utilisateur.role || "0";
    }

    closeUpdateUserBtn.addEventListener("click", () => {
        modalUpdateUser.style.display = "none";
    });

    document.querySelectorAll(".btn-edit-user").forEach(button => {
        button.addEventListener("click", () => {
            const utilisateur = JSON.parse(button.dataset.utilisateur);
            openUpdateUserModal(utilisateur);
        });
    });
});
