<?php
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$blocks = new blocks;
$content = new content;
if ($_SERVER[REQUEST_METHOD]=="POST"){
	//print_r($_FILES);
	$tmp = $_FILES['user_file']['tmp_name'];
	$name = $_FILES['user_file']['name'];
	move_uploaded_file($tmp, '../pics/blocks/'.$name);
	$img = serialize($name);
	$id = $blocks->clearInt($_POST['id']);
	$id = "bl$id";
	$title = $blocks->clearStr($_POST['title']);
	$descr = $blocks->clearStr($_POST['descr']);
	$res = $blocks->addDir($id, $title, $img, $descr);
	if ($res == false){
		header('Content-Type: text/html; charset=utf-8');
		echo "Произошла ошибка при добавлении блока";
	}else{
		$content = new content;
		$res = $content->createDirDB($id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении директории database $title";
		}else{
			Header ('Location: blocks.php');
			exit;
		}
	}	
}
?>