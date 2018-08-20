<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$blocks = new blocks;
if ($_SERVER[REQUEST_METHOD]=='GET'){
	$id = $blocks->clearStr($_GET['id']);
	$res = $blocks->deleteBlock($id);
	if (!$res)
		echo "Произошла ошибка при удалении";
	else{
		$content = new content;
		$res = $content->deleteDirDB($id);
		if ($res !== true){
			echo $res;
		}else{
		header ('Location: blocks.php');
		exit;
		}
	}
}

?>