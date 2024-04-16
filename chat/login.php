<?php

session_start();
require_once 'functions.php';
require_once 'database.php'; // Підключення до бази даних

// Перевірка, чи користувач вже увійшов у систему
if (isset($_SESSION['email'])) {
    echo "Ви увійшли до системи як: " . $_SESSION['email'];
    echo "<br>";
    echo "<a href='delete_account.php'>Видалити профіль</a>";
    echo "<br>";
    echo "<a href='logout.php'>Вийти з системи</a>";
    exit;
}

// Обробка логіну
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Перевірка даних користувача
    if (!validateEmail($email) || !checkStringLength($password, 6, 20)) {
        echo "Email або пароль невірні.";
        exit;
    }

    // Підключення до бази даних
    $conn = connectToDatabase();

    // Перевірка існування користувача в базі даних та правильності пароля
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Успішний вхід - зберігаємо дані в сесію та перенаправляємо на головну сторінку
        $_SESSION['email'] = $email;
        header("Location: chat.php");
        exit;
    } else {
        echo "Email або пароль невірні.";
    }

    // Закриття з'єднання
    $conn = null;
}
?>

<!-- HTML-форма для входу -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід у систему</title>
</head>
<body>
<h2>Вхід у систему</h2>
<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="text" name="email" required>
    <br>
    <label for="password">Пароль:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Увійти">
</form>
<p>Не маєте акаунту? <a href="register.php">Зареєструйтесь</a></p>
<p><a href="delete_account.php">Видалити свій профіль</a></p> <!-- Додане посилання -->
</body>
</html>
