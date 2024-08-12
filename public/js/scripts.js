document.addEventListener("DOMContentLoaded", function () {
  const accountUserImage = document.getElementById("uploadedAvatar");
  const fileInput = document.getElementById("avatar");
  const resetFileInput = document.querySelector(".account-image-reset");

  if (accountUserImage && fileInput) {
    const resetImage = accountUserImage.src;

    fileInput.addEventListener("change", function () {
      if (fileInput.files && fileInput.files[0]) {
        const fileType = fileInput.files[0].type;
        const allowedTypes = ["image/jpeg", "image/png", "image/gif"];

        if (allowedTypes.includes(fileType)) {
          // Crear la URL de la imagen seleccionada
          const imgURL = URL.createObjectURL(fileInput.files[0]);
          accountUserImage.src = imgURL;
          accountUserImage.onload = () => {
            URL.revokeObjectURL(imgURL); // Liberar memoria
          };
        } else {
          alert("Invalid file type. Only JPG, PNG, and GIF are allowed.");
          fileInput.value = ""; // Reset file input
          accountUserImage.src = resetImage; // Reset image to original
        }
      }
    });

    if (resetFileInput) {
      resetFileInput.addEventListener("click", function () {
        fileInput.value = "";
        accountUserImage.src = resetImage;
      });
    }
  }
});
