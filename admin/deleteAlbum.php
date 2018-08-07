<?
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$content = new content;
$albums = new album;
$fotos = new fotos;

if ($_SERVER[REQUEST_METHOD]=='GET'){
	$id = $content->clearStr($_GET['id']);
	$albumDir = $albums->getOneDir($id);
	$title = $albums->getNameDir($id); //название альбома
	
	$albumFotos = $content->getDivs($id);
	if (!is_array($albumFotos)){
		header('Content-Type: text/html; charset=utf-8');
		echo 'произошла ошибка при чтении содержимого альбома';
		exit;
	}
	else if ($albumFotos != false){ //удаление фотографий из альбома
		foreach($albumFotos as $row){
		
			$fotoId = $row['id'];
			$srcArr = $fotos->getOneDir($fotoId);
			$src = $srcArr[0]['title']; 
			
			if (file_exists($src))
				unlink ($src);
			$res = $fotos->deleteDir($fotoId);
			if (!$res){
				header('Content-Type: text/html; charset=utf-8');
				echo "Произошла ошибка при удалении фотографии $FotoId из альбома";
			}
			$res = $content->deleteDirDB($fotoId);
			if (!$res){
				header('Content-Type: text/html; charset=utf-8');
				echo "Произошла ошибка при удалении директории фотографии $FotoId из базы данных";
			}	
		}
	}
		if ($id == $albumDir['0']['id']){
			$res = $albums->deleteDir($id);
			if (!$res){
				header('Content-Type: text/html; charset=utf-8');
				echo "Произошла ошибка при удалении директории из альбомов";
			}
			$res = $content->deleteDirDB($id);
			if (!$res){
				header('Content-Type: text/html; charset=utf-8');
				echo "Произошла ошибка при удалении директории из базы данных";
			}else{
			header ("Location: albums.php");
			exit;
			}
		}
}
?>