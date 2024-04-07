<?php
require_once ('functions.php');
require_once ('error.php');

if ($id = ($_GET['id'] ?? '')) {
    $removeMessages = removeMessages($id);
    header("Location: index.php");
}

if (!empty($_POST)) {
    $username = $_POST['username'] ?? '';
    $userMessages = $_POST['message'] ?? '';
    $header = $_POST['header'] ?? '';
    $error = validateUserName($username);
    $erro = validateUserMessages($userMessages);
    $err = validateheader ($header);
    var_dump($error,$erro,$err);
    if (!$error && !$erro && !$err) {
        $addMessages = addMessages($username,$userMessages,$header);
        header("Location: index.php");
    }
}
$messages = getMessages();

echo hash('sha256', $_SESSION['email']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <!-- Підключення Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .message {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .message img {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>


<!-- Хедер з посиланнями на головну і чат -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Головна</a>
        <a class="navbar-brand" href="#">Чат</a>
    </div>
</nav>

<!-- Контейнер для центрування контенту -->
<div class="container justify-content-center align-items-center mt-4" style="min-height: 80vh;">
    <div class="row">
        <div class="col-md-4">
            <!-- Форма для введення повідомлення -->
            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= !empty($_SESSION['email']) ? $_SESSION['email']: ''?>">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">header</label>
                    <textarea class="form-control" id="header" name="header" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>
        <div class="col-md-8">
            <!-- Список повідомлень -->
            <? foreach($messages as $message): ?>
                <div class="message">
                    <img src="https://via.placeholder.com/30" alt="User Avatar">
                    <div>
                        <strong><?=$message['username']?></strong>
                        <p><?=$message['message']?></p>
                        <p><?=$message['header']?></p>
                        <a href="index.php?id=<?=$message['id']?>">Х</a>
                    </div>

                </div>

            <? endforeach; ?>

            </div>
            <!-- Додавання інших повідомлень сюди -->
        </div>
    </div>
</div>

<!-- Підключення Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
