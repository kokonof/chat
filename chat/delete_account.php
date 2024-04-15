<?php
session_start();
require_once 'database.php'; // Підключення до бази даних

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm']) && $_POST['confirm'] == 'true') {
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Підключення до бази даних
        $conn = connectToDatabase();

        // Видалення користувача з бази даних
        $sql = "DELETE FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            // Видалення сесії та перенаправлення на сторінку виходу
            session_destroy();
            header("Location: logout.php");
            exit();
        } else {
            echo "Помилка видалення облікового запису.";
        }

        // Закриття з'єднання
        $conn = null;
    } else {
        echo "Помилка: Користувач не увійшов у систему.";
    }
}
?>

<!-- HTML-форма для видалення облікового запису -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Видалення облікового запису</title>
</head>
<body>
<h2>Видалення облікового запису</h2>
<p>Ви впевнені, що хочете видалити свій обліковий запис?</p>
<form method="POST" action="">
    <input type="hidden" name="confirm" value="true">
    <input type="submit" value="Підтвердити видалення">
</form>
</body>
</html>