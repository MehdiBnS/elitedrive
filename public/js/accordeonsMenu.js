document.querySelectorAll(".accordion-header").forEach(header => {
    header.addEventListener("click", () => {
        const content = header.nextElementSibling;

        // Fermer tous les autres accordéons
        document.querySelectorAll(".accordion-content").forEach(otherContent => {
            if (otherContent !== content) {
                otherContent.style.display = "none";
            }
        });

        // Alternance d'affichage du contenu de l'accordéon cliqué
        content.style.display = content.style.display === "block" ? "none" : "block";
    });
});
const headers = document.querySelectorAll('.accordion-header-admin');
const contents = document.querySelectorAll('.accordion-content-admin');

headers.forEach((header, index) => {
    header.addEventListener('click', () => {
        contents.forEach((content, i) => {
            content.style.display = i === index
                ? (content.style.display === 'block' ? 'none' : 'block')
                : 'none';
        });

        headers.forEach((h, i) => {
            if (i === index && contents[index].style.display === 'block') {
                h.style.backgroundColor = 'white';
                h.style.fontWeight = 'bold';
                h.style.color = 'darkgoldenrod';             
            } else {
                h.style.backgroundColor = '';
                h.style.fontWeight = '';
                h.style.color = '';
            }
        });
    });
});

