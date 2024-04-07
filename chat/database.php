<?php
function connectToDatabase()
{
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
    } catch (PDOException $e) {
        // Обробка помилок під час з'єднання
        die("Помилка з'єднання: " . $e->getMessage());
    }
}