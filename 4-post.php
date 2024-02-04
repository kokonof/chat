<?php

	echo $_SERVER['REQUEST_METHOD'];
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';

?>
<form method="post">
	<input type="text" name="a">
	<input type="text" name="b">
	<button>Send</button>
</form>