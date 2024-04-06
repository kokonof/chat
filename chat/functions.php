<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "test_db";

    try {
        // Створення з'єднання з використанням PDO
        $dsn = "mysql:host=$servername;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);

        // Встановлення режиму помилок PDO на викид винятків
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch(PDOException $e) {
        // Обробка помилок під час з'єднання
        die("Помилка з'єднання: " . $e->getMessage());
    }
}
function getMessages() : array {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для вибірки всіх записів
    $sql = "SELECT * FROM messages";

    try {
        // Підготовка та виконання запиту з використанням PDO
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        // Отримання результатів запиту
        $articlesArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Закриваємо з'єднання
        $conn = null;

        return $articlesArray;
    } catch(PDOException $e) {
        // Обробка помилок під час виконання запиту
        die("Помилка запиту: " . $e->getMessage());
    }
}

function addMessages($username, $message,$header) : bool {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для вставки нового запису
    $sql = "INSERT INTO messages (username, message,header) VALUES (:username, :message,:header)";

    try {
        // Підготовка та виконання запиту з використанням PDO
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':header',$header);
        $result = $stmt->execute();

        // Закриваємо з'єднання
        $conn = null;

        return $result;
    } catch(PDOException $e) {
        // Обробка помилок під час виконання запиту
        die("Помилка запиту: " . $e->getMessage());
    }
}
function removeMessages(int $id) : bool {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для видалення запису за ідентифікатором
    $sql = "DELETE FROM messages WHERE id = :id";

    try {
        // Підготовка та виконання запиту з використанням PDO
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $result = $stmt->execute();

        // Закриваємо з'єднання
        $conn = null;

        return $result;
    } catch(PDOException $e) {
        // Обробка помилок під час виконання запиту
        die("Помилка запиту: " . $e->getMessage());
    }
}