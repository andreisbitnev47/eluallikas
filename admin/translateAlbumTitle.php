<?
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$albums = new album;
	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$id = $albums->clearStr($_POST['id']);
		$titleRus = $albums->clearStr($_POST['titleRus']);
		$res = $albums->translateTitle($id, $titleRus);
		if(!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при переводе';
		}else
			header('Location: albums.php');		
	}
	
?>
		