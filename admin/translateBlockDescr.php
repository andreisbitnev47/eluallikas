<?
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$blocks = new blocks;
	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$id = $blocks->clearStr($_POST['blockId']);
		$descrRus = $blocks->clearStr($_POST['descrRus']);
		$res = $blocks->translateDescr($id, $descrRus);
		if(!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при переводе';
		}else
			header('Location: blocks.php');		
	}
	
?>
		