
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перевірка довжини рядка</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="email">email:</label>
        <input type="text"  name="email">
        <br>
        <label for="password">password:</label>
        <input type="text"  name="password">
        <br>
        <input type="submit" value="Перевірити">
    </form>
</body>
</html>

<?php
require_once 'functions.php';
// Перевірка, чи дані були відправлені методом POST
if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Перевірка довжини пароля
    if (!checkStringLength($password, 6, 20)) {
        echo "Пароль повинен містити від 6 до 20 символів.";
        exit; // Припиняємо виконання скрипту
    }

    if (!validateEmail($email)) {
        echo "Email not valid";
        exit;
    }


    // стукнути в базу і взяти юзера
    // і в сесію треба класти токен по якому ти потім будеш робити запити
    $_SESSION['email'] = $email;
    header("Location: index.php");

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Помилка: дані не були передані.";
}

?>