const popup = document.querySelector('.popup-background');

popup.addEventListener('click', (e) => {
    if (e.target.classList.contains('popup-background')) popup.classList.add('hide');
});