import './bootstrap';


// Open file
const openFile = document.getElementById('open-file');
const avatarFile = document.getElementById('avatar-file');
const avatarImg = document.getElementById('img-avatar');
openFile?.addEventListener('click', () => {
    avatarFile.click();
});

avatarFile?.addEventListener('change', (e) => {
    const [file] = avatarFile.files;
    if(file){
        avatarImg.src = URL.createObjectURL(file);
    }
});

// Open and close the model
const btnOpen = document.getElementById('btn-open-model');
const btnClose = document.getElementById('btn-close-model');
const model = document.getElementById('model');
btnOpen?.addEventListener('click', () => {
    model.classList.remove('hidden');
});
btnClose?.addEventListener('click', () => {
    model.classList.add('hidden');
})