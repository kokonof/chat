
<?php
require_once 'functions.php';
require_once 'database.php';
// Перевірка, чи дані були відправлені методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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


    $conn = connectToDatabase();

    $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
    $stmt = $conn->prepare($sql);// Код для вставки нового користувача в базу даних
    if ($stmt->execute()) {
        echo "Вітаємо, $username! Ваша реєстрація успішно завершена.";

        // Додати перенаправлення користувача на залогінену сторінку
        header("Location: logged_in_page.php");
        exit; // Важливо додати exit після header, щоб переконатися, що код далі не виконується
    } else {
        echo "Помилка при реєстрації: " . $stmt->errorInfo()[2];
    }


    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);

    if ($stmt->execute()) {
        echo "Вітаємо, $username! Ваша реєстрація успішно завершена.";
    } else {
        echo "Помилка при реєстрації: " . $stmt->errorInfo()[2];
    }

    $conn = null;
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
    <form action="index.php" method="post">
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