<?php
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$navigation = new nav;
	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$id = $navigation->clearStr($_POST['id']);
		$titleRus = $navigation->clearStr($_POST['titleRus']);
		$res = $navigation->translateDir($id, $titleRus);
		if(!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при переводе';
		}else
			header('Location: navigation.php');		
	}
	
?>
		