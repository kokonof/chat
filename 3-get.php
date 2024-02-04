<?php

	echo '<pre>';
	print_r($_GET);
	echo '</pre>';

	$id = (int)($_GET['id'] ?? '');
	echo $id;