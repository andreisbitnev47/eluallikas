<?
	header('Content-Type: text/html; charset=utf-8');
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$content = new content;
	$albums = new album;
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$albumCnt = $albums->albumCnt();
		
		$lastId = $content->clearInt($albumCnt);
		if ($lastId<9){
			$idNum = $lastId + 1;
			$idNum = '0'.$idNum;
		}else{
			$idNum = $lastId + 1;
		}
		$id = 'alb'.$idNum;
	
		$title=$content->clearStr($_POST['title']);	
		$tmp = $_FILES['uploaded_image']['tmp_name'];
		$name = $_FILES['uploaded_image']['name'];
		move_uploaded_file($tmp, '../pics/pagePics/'.$name);
		$src = 'http://eluallikas.ee/pics/pagePics/'.$name;
		}
		$res = $content->createDirDB($id);
		if (!$res ){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении директории database $id";
			exit;
		}
		
		$res = $albums->addDir($title, $id, $src);
		if (!$res ){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении альбома $title";
		}else{
			header ("Location: albums.php");
		}
?>