<?php
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$nav = new nav;
$errMsg="";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Страницы сайта</title>
	</head>
	<body>
		<h1>Страницы сайта (отображаются сверху справа в навигации)</h1>
		<a href='index.php'>Назад в Админку</a>
<ul>
	<?php
		$navigation = new nav;
		$navDir = $navigation->getDir();
		if (!is_array($navDir))
			$errMsg = "Ошибка при выводе меню";
		elseif ($navDir==NULL)
			$errMsg = "В меню нет директорий";
		foreach ($navDir as $row){
	?>
	<li><?php echo $row['id']?>. <?php echo  $row['title']?> / <?php echo  $row['titleRus']?> <a href="deleteNavDir.php?id=<?php echo $row['id']?>">Удалить</a> 
		<form method="POST" action="translateNavDir.php">
		<input type="hidden" name="id" value='<?php echo  $row['id']?>'>
		<input type="text" name="titleRus">
		<input type="submit"  value='Перевести название страницы'></form></li>
		
		<form method="POST" action="content.php">
		<input type="hidden" name="title" value='<?php echo  $row['title']?>'>
		<input type="submit"  value='Изменить'></form></li>
	<?php
		}
		echo "</ul>";
		echo $errMsg;
	?>
	<br>
	<h2>Добавить новую страницу</h2>
	<form action="saveNavDir.php" method="POST">
		Порядковый номер: <input type="text" name="id"><br>
		Название директории: <input type="text" name="title"><br>
		<input type="submit" value="Добавить">
	</body>
</html>