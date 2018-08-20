<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$navigation = new nav;
$content = new content;
if ($_SERVER[REQUEST_METHOD]=="POST"){
	$id = $navigation->clearInt($_POST['id']);
	$title = $navigation->clearStr($_POST['title']);
	$title = $navigation->clearBlanks($title);
	$res = $navigation->addDir($title, $id);
	if ($res == false){
		header('Content-Type: text/html; charset=utf-8');
		echo "Произошла ошибка при добавлении директории directory";
	}	
	else{
		$content = new content;
		$res = $content->createDirDB($title);
		if ($res == false){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении директории database $title";
		}else{
			Header ('Location: navigation.php');
			exit;
		}
	}
}
?>