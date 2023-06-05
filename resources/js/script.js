document.addEventListener('DOMContentLoaded', function() {
    const modeSwitcher = document.getElementById('darkmodesidebar');
    modeSwitcher.checked = document.body.classList.contains('dark-mode-active');
    modeSwitcher.addEventListener('click', function(evt) {
        const isChecked = evt.target.checked;
        if(isChecked) {
            document.body.classList.add('dark-mode-active');
        } else {
            document.body.classList.remove('dark-mode-active');
        }
    });
});
const btnUpload = document.getElementById('btnUpload')
const uploadInput = document.getElementById('upload')
const fileNamePreview = document.getElementById('fileNamePreview')
btnUpload.addEventListener('click', function () {
    uploadInput.click()
})
uploadInput.addEventListener('change', function (evt) {
    const file = evt.target.files[0];
    fileNamePreview.value = file.name;
})
