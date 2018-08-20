<?php
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$errMsg="";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Фотоальбомы</title>
	</head>
	<body>
		<h1>Фотоальбомы</h1>
		<a href='index.php'>Назад в админку</a>
<ul>
	<?php
		$albums = new album;
		$album = $albums->getDir();
		$albumCnt = $albums->albumCnt();
		if (!is_array($album))
			$errMsg = "Ошибка при выводе альбомов";
		elseif ($album==NULL)
			$errMsg = "Не создано ни одного альбома";
		foreach ($album as $row){
	?>
	<li><?php echo $row['id']?>. <?php echo  $row['title']?>/<?php echo  $row['titleRus']?> <a href="deleteAlbum.php?id=<?php echo $row['id']?>">Удалить</a>
		
		<form method="POST" action="translateAlbumTitle.php">
			<input type="hidden" name="id" value="<?php echo  $row['id']?>">
			Русское название<input type="text" name="titleRus">
		<input type="submit"  value='Перевести'></form></li>
		
		<form method="Post" action="fotos.php">
			<input type="hidden" name="title" value="<?php echo  $row['title']?>">
			<input type="hidden" name="id" value="<?php echo  $row['id']?>">
		<input type="submit"  value='Добавить фотографии'></form></li>
	<?php
		}
		echo "</ul>";
		echo $errMsg;
	?>
	<h2>Добавить новый альбом</h2>
	<form action="saveAlbum.php" method="POST" enctype="multipart/form-data">
		Заголовок: <input type="text" name="title"><br>
		Заглавная фотка:<br>
		<input type="file" name="uploaded_image">
		<input type="submit" value="Добавить">
	</form>
	
	</body>
</html>