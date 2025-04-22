const stars = document.querySelectorAll('.star');
const rateInput = document.getElementById('rate');

let selectedValue = 0;

stars.forEach(star => {
    star.addEventListener('mouseover', () => {
        const value = parseInt(star.getAttribute('data-value'));
        stars.forEach(s => {
            s.style.color = (parseInt(s.getAttribute('data-value')) <= value) ? 'darkgoldenrod' : 'grey';
        });
    });

    star.addEventListener('mouseout', () => {
        stars.forEach(s => {
            s.style.color = (parseInt(s.getAttribute('data-value')) <= selectedValue) ? 'darkgoldenrod' : 'grey';
        });
    });

    star.addEventListener('click', () => {
        selectedValue = parseInt(star.getAttribute('data-value'));
        rateInput.value = selectedValue;

        stars.forEach(s => {
            if (parseInt(s.getAttribute('data-value')) <= selectedValue) {
                s.classList.add('selected');
            } else {
                s.classList.remove('selected');
            }
        });
    });
});
