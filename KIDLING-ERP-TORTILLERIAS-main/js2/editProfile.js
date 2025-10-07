//Editar profile
document.addEventListener('DOMContentLoaded', function () {
    var uploadButton = document.getElementById('upload-button');
    var profileImageUpload = document.getElementById('profile-image-upload');

    uploadButton.addEventListener('click', function () {
        // Simula un clic en el input de tipo file
        profileImageUpload.click();
    });

    profileImageUpload.addEventListener('change', function (event) {
        var profileImage = document.getElementById('profile-image');
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function () {
            profileImage.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    });
});

function irAlDashboard(){
    window.location.href = "../index.html";
}