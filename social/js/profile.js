document.addEventListener("DOMContentLoaded", async function () {
    const accountCreationDate = document.getElementById("accaunt-creation-date");
    const userEmail = document.getElementById("user-email");
    const userInfo = document.getElementById("user-info");
    // Функция для загрузки информации о пользователе
    async function loadProfileInfo() {
        try {
            const response = await fetch('getProfileInfo.php', {
                method: 'POST',
            });
            const data = await response.text();
            // Разбиваем строку на отдельные значения
            const [email, created, info] = data.split('|');
            // Устанавливаем значения полей профиля
            userEmail.innerText = email;
            accountCreationDate.innerText = created;
            userInfo.innerText = info;
        } catch (error) {
            console.error(error.message);
        }
    }
    // Загружаем информацию о пользователе при загрузке страницы
    loadProfileInfo();
});
