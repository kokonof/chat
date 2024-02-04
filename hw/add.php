<?php

	include_once('functions.php');

$isSend = false;
$err = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    var_dump($_POST);
    if($title === '' || $content === ''){
        $err = 'Заполните все поля!';
    }
    else if(mb_strlen($title, 'UTF8') < 2){
        $err = 'Имя не короче 2 символов!';
    }
    else{
        addArticle( $title,$content, 'Bond');
//        addArticle( 'НАзва поста', 'Контент поста');
        $isSend = true;
     header('Location: /hw');
    }
}
else{
    $title = '';
    $content = '';
}

?>
<div class="form">
    <? if($isSend): ?>
        <p>Your app is done!</p>
    <? else: ?>
        <form method="post">
            title:<br>
            <input type="text" name="title" value="<?=$title?>"><br>
            content:<br>
            <input type="text" name="content" value="<?=$content?>"><br>
            <button>Send</button>
            <p><?=$err?></p>
        </form>
    <? endif; ?>
</div>