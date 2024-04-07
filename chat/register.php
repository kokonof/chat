
<?php
require_once 'functions.php';
// Перевірка, чи дані були відправлені методом POST
if (!empty($_POST)) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Перевірка довжини імені
    if (!checkStringLength($username, 3, 15)) {
        echo "імя повине містити від 3 до 15 символів." . "<br>";
//        exit; // Припиняємо виконання скрипту
    }
    if (!checkStringLength($password, 6, 20)) {
        echo "Пароль повинен містити від 6 до 20 символів." . "<br>";
//        exit; // Припиняємо виконання скрипту
    }
    if (!checkStringLength($confirm_password, 6, 20)) {
        echo "Підтвердження Пароля повинен містити від 6 до 20 символів." . "<br>";
//        exit; // Припиняємо виконання скрипту
    }
    if (!validateEmail($email)) {
        echo "Email not valid" . "<br>";
//        exit;
    }



    // стукнути в базу і реєструвати юзера
    // і в сесію треба класти токен по якому ти потім будеш робити запити
//    $_SESSION['email'] = $email;
//    header("Location: index.php");

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Помилка: дані не були передані.";
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
</head>
<body>
    <h2>Форма реєстрації</h2>
    <form action="register.php" method="post">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username" ><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" ><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" ><br><br>

        <label for="confirm_password">Підтвердження паролю:</label>
        <input type="password" id="confirm_password" name="confirm_password" ><br><br>

        <button type="submit">Зареєструватися</button>
    </form>
</body>
</html>