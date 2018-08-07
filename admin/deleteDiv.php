<?
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$content = new content;
$albums = new album;

if ($_SERVER[REQUEST_METHOD]=='GET'){
	$id = $content->clearStr($_GET['id']);
	$pageName = $content->clearStr($_GET['pageName']);
	$albumDir = $albums->getOneDir($id);
	$title = $albums->getNameDir($id); //название альбома
	
	if ($id == $albumDir['0']['id']){
		$res = $albums->deleteDir($id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при удалении директории из альбомов";
		}
		$res = $content->deleteDirDB($title);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при удалении директории из базы данных";
		}		
	}
	$res = $content->deleteDiv($id, $pageName);
	if (!$res){
		echo "Произошла ошибка при удалении direction";
	}else{
		header ("Location: content.php?title=$pageName");
		exit;
		}	
}
?>