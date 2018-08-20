<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$nav = new nav;
if ($_SERVER[REQUEST_METHOD]=='GET'){
	$id = $nav->clearStr($_GET['id']);
	$name = $nav->getNameDir($id);
	$res = $nav->deleteDir($id);
	if (!$res){
		echo "Произошла ошибка при удалении direction";
	}
	else{
		$content = new content;
		$res = $content->deleteDirDB($name);
		if ($res !== true){
			echo $res;
		}else{
		header ('Location: navigation.php');
		exit;
		}
	}
}
?>