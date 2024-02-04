<?php

	include_once('functions.php');


$id = (int)($_GET['id'] ?? '');
removeArticle($id);

?>
Message about result
<hr>
<a href="index.php">Move to main page</a>