<?php

	include_once('functions.php');
$id = (int)($_GET['id'] ?? '');
	$article = getArticleById($id);


//	$post = $articles[$id] ?? null;
	$hasPost = ($article !== null);

?>
<div class="content">
	<? if($hasPost): ?>
		<div class="article">
			<h1><?=$article['title']?></h1>
			<div><?=$article['content']?></div>
			<hr>
			<a href="delete.php?id=<?=$article['id']?>">Remove</a>
		</div>
	<? else: ?>
		<div class="e404">
			<h1>Страница не найдена!</h1>
		</div>
	<? endif; ?>
</div>
<hr>
<a href="index.php">Move to main page</a>