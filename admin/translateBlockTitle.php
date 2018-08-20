<?php
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$blocks = new blocks;
	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$id = $blocks->clearStr($_POST['blockId']);
		$titleRus = $blocks->clearStr($_POST['titleRus']);
		$res = $blocks->translateTitle($id, $titleRus);
		if(!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при переводе';
		}else
			header('Location: blocks.php');		
	}
	
?>
		