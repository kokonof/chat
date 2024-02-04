<?php
	declare(strict_types=1);

	function getArticle(){

	}

	function checkId(string $id) : bool{
		return ctype_digit($id);
	}