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

const btnLogoUpload = document.getElementById('btnLogoUpload')
const uploadLogo = document.getElementById('uploadLogo')
const logoNamePreview = document.getElementById('logoNamePreview')
btnLogoUpload.addEventListener('click', function () {
    uploadLogo.click()
})
uploadLogo.addEventListener('change', function (evt) {
    const file = evt.target.files[0];
    logoNamePreview.value = file.name;
})

const btnFaviconUpload = document.getElementById('btnFaviconUpload')
const uploadFavicon = document.getElementById('uploadFavicon')
const faviconNamePreview = document.getElementById('faviconNamePreview')
btnFaviconUpload.addEventListener('click', function () {
    uploadFavicon.click()
})
uploadFavicon.addEventListener('change', function (evt) {
    const file = evt.target.files[0];
    faviconNamePreview.value = file.name;
})

