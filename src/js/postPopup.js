const btn = document.querySelector('.add-post-button');
const popup = document.querySelector('.popup-background');

btn.addEventListener('click', () => {
    popup.classList.remove('hide');
});

popup.addEventListener('dblclick', (e) => {
    if (e.target.classList.contains('popup-background')) popup.classList.add('hide');
});