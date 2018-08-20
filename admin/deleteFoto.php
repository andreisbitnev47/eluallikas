<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$content = new content;
$fotos = new fotos;

	if ($_SERVER[REQUEST_METHOD]=='GET'){
		$id = $content->clearStr($_GET['id']);
		$pageName = $content->clearStr($_GET['pageName']);
		$pageId = $content->clearStr($_GET['pageId']);
		$srcArr = $fotos->getOneDir($id);
		$src = $srcArr[0]['title'];
		if (file_exists($src))
			unlink ($src);
		$res = $fotos->deleteDir($id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при удалении фотографии из альбома";
		}
		$res = $content->deleteDirDB($id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при удалении директории из базы данных";
		}		
		$res = $content->deleteDiv($id, $pageId);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при удалении DIV";
		}else{
			header ("Location: fotos.php?title=$pageName&id=$pageId");
			exit;
			}	
	}
?>