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
		<title>Блоки сайта</title>
		<style>
			ul {list-style-type:none;}
			.block {border: 1px solid black;
					padding: 10px;
					width: 320px}
			img {width:150px;
				height:150px;}
			p {width: 300px;
				border: 1px solid black;
				padding: 10px;
			}
			span {font-weight: bold;}
		</style>
	</head>
	<body>
		<h1>Блоки сайта</h1>
		<a href='index.php'>Назад в админку<a/>
	<?php
		$blocks = new blocks;
		$blockDir = $blocks->getBlocks();
		if (!is_array($blockDir))
			$errMsg = "Ошибка при выводе меню";
		elseif ($blockDir==NULL)
			$errMsg = "В меню нет директорий";
		echo "<ul>";
		foreach ($blockDir as $row){
	?>
	<div class="block"><li><h3><?php echo $row['id']?>. <?php echo  $row['title']?>/<?php echo  $row['titleRus']?></h3>
	
	<form action="translateBlockTitle.php" method="POST">
		<input type="hidden" name="blockId" value="<?php echo $row['id']?>">
		Название по русски: <input type="text" name="titleRus">
		<input type="submit" value="Перевести">
	</form>
	
	<img src="../pics/blocks/<?php echo unserialize($row['img'])?>"><br>
	<span>Краткое описание:</span><p><?php echo $row['descr']?></p><p><?php echo $row['descrRus']?></p>
	
	<form action="translateBlockDescr.php" method="POST">
		<input type="hidden" name="blockId" value="<?php echo $row['id']?>">
		Описание на русском: <br><textarea cols="30" rows="7" name="descrRus"></textarea><br>
		<input type="submit" value="Перевести">
	</form>
	
	<form action="content.php" method="POST">
		<input type="hidden" name="title" value="<?php echo  $row['id']?>">
		<input type="submit" value="Изменить содержимое страницы">
	</form><br>
	
	<a href="deleteBlockDir.php?id=<?php echo $row['id']?>">Удалить блок</a></li></div>
	<?php
		}
		echo "</ul>";
		echo $errMsg;
	?>
	<br>
	<br>
	<h2>Добавить новый раздел</h2>
	<form action='saveBlockDir.php' method='post' enctype='multipart/form-data'>
		Порядковый номер: <input type="text" name="id"><br>
		Название раздела: <input type="text" name="title"><br>
		Краткое описание:<br><textarea cols="35" rows="7" name="descr"></textarea><br>
		<input type='file' name='user_file'>
		<input type='submit'>
	</form>
	</body>
</html>