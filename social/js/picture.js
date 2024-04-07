document.addEventListener("DOMContentLoaded", async function () {
    // Получаем ссылки на кнопки и элементы ввода файла, а также на профильную картинку
    const updatePictureButton = document.getElementById("update-picture");
    const deletePictureButton = document.getElementById("delete-picture");
    const fileInput = document.getElementById("file-input");
    const profilePicture = document.getElementById("profile-picture");
    // Функция для удаления профильной картинки
    async function deleteProfilePicture() {
    return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
     xhr.open("POST", "upload-profile-picture.php", true);
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
     xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
     resolve(xhr.responseText);
     }
     };
     xhr.send("action=delete");
     });
     }
    // Обработчик события клика на кнопку "Обновить картинку"
     updatePictureButton.addEventListener("click", function () {
     fileInput.click();
     });
    // Обработчик события изменения в поле ввода файла
     fileInput.addEventListener("change", async function () {
    // Создание объекта FormData для отправки файла на сервер
    const formData = new FormData();
     formData.append("action", "update");
     formData.append("image", fileInput.files[0]);
    try {
    // Загрузка профильной картинки на сервер и обновление ее на странице
    const response = await uploadProfilePicture(formData);
    if (response.startsWith("success")) {
     profilePicture.src = response.split("|")[1];
     }
     location.reload(); // Перезагрузка страницы
     } catch (error) {
     console.error(error.message);
     }
     });
     deletePictureButton.addEventListener("click", async function () {
        try {
        // Удаление профильной картинки на сервере и обновление ее на странице
        const response = await deleteProfilePicture();
        if (response.startsWith("success")) {
         profilePicture.src = "avatars/placeholder.png";
        const updatedProfilePicturePath = await getProfilePicture();
        if (updatedProfilePicturePath !== "null") {
         profilePicture.src = updatedProfilePicturePath;
         } else {
         profilePicture.src = "avatars/placeholder.png";
         }
         }
         location.reload(); // Перезагрузка страницы
         } catch (error) {
         console.error(error.message);
         }
         });
        // Функция для получения пути к текущей профильной картинке
        async function getProfilePicture() {
        return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
         xhr.open("POST", "upload-profile-picture.php", true);
         xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
         xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
         resolve(xhr.responseText);
         }
         };
         xhr.send("action=getProfilePicture");
         });
         }
        // Функция для загрузки профильной картинки на сервер
        async function uploadProfilePicture(formData) {
        return new Promise((resolve, reject) => {
        const xhr = new XMLHttpRequest();
         xhr.open("POST", "upload-profile-picture.php", true);
         xhr.onload = function () {
        if (xhr.status === 200) {
         resolve(xhr.responseText);
         } else {
         reject(new Error("Ошибка загрузки изображения"));
        }
    };
    xhr.send(formData);
    });
    }
   // Получаем текущий путь к профильной картинке и устанавливаем его в качестве источника изображения
   const profilePicturePath = await getProfilePicture();
   if (profilePicturePath !== "null") {
    profilePicture.src = profilePicturePath;
    } else {
    profilePicture.src = "avatars/placeholder.png";
    }
   });
       