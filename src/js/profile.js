const btn = document.getElementById('profile-image-upload-div');
const fileInput = document.getElementById('profile-image-upload-input');
const image = document.querySelector('.profile-image > img');
const uploadBtn = document.querySelector('.profile-upload-btn');
const closeBtn = document.querySelector('.profile-close-btn');


btn.addEventListener('click', function () {
    fileInput.click();
});

fileInput.addEventListener('change', function () {
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        image.src = e.target.result;

        if (uploadBtn.classList.contains('hidden')) {
            uploadBtn.classList.remove('hidden');
            closeBtn.classList.remove('hidden');
        }

    };

    reader.readAsDataURL(file);

});

closeBtn.addEventListener('click', () => {
    image.src = 'src/assets/avatar.png';
    uploadBtn.classList.add('hidden');
    closeBtn.classList.add('hidden');
    fileInput.value = '';
});
