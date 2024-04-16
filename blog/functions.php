<?php
session_start();

function getArticles() : array {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для вибірки всіх записів
    $sql = "SELECT * FROM articles";

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


function addArticle(string $title, string $content, $author = 'User') : bool {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для вставки нового запису
    $sql = "INSERT INTO articles (title, content) VALUES (:title, :content)";

    try {
        // Підготовка та виконання запиту з використанням PDO
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $result = $stmt->execute();

        // Закриваємо з'єднання
        $conn = null;

        return $result;
    } catch(PDOException $e) {
        // Обробка помилок під час виконання запиту
        die("Помилка запиту: " . $e->getMessage());
    }
}



function removeArticle(int $id) : bool {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для видалення запису за ідентифікатором
    $sql = "DELETE FROM articles WHERE id = :id";

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

function getArticleById(int $id) {
    // Підключення до бази даних
    $conn = connectToDatabase();

    // SQL-запит для вибірки одного запису за ідентифікатором
    $sql = "SELECT * FROM articles WHERE id = :id";

    try {
        // Підготовка та виконання запиту з використанням PDO
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Отримання результату запиту
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        // Закриваємо з'єднання
        $conn = null;

        return $article;
    } catch(PDOException $e) {
        // Обробка помилок під час виконання запиту
        die("Помилка запиту: " . $e->getMessage());
    }
}
