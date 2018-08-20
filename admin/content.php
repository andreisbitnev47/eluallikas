<?php
	header('Content-Type: text/html; charset=utf-8');
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$content = new content;
	$albums = new album;
	$albumArr = $albums->getDir()
?>
<!DOCTYPE html>
<html>
	
<?php	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$pageName = $content->clearStr($_POST['title']);
	}
	if ($_SERVER[REQUEST_METHOD]=='GET'){
		$pageName = $content->clearStr($_GET['title']);
	}
?>
		<head>
			<title>Редактор страницы <?php echo $pageName?></title>
			<style>
				body {width: 1000px;
					background: white;
				}
				.content, #form_1, #form_2 {width: 960px;
						margin: 20px;
						float:left;
				}

			</style>
		</head>
		<body>
			<h1>Блоки страницы "<?php echo $pageName?>"</h1>
			<?php
			if(substr($pageName, 0, 2) == 'bl')
				$hrefBack = 'blocks.php';
			else 
				$hrefBack = 'navigation.php';
			?>
			<a href="<?php echo $hrefBack?>">Назад к страницам сайта</a>
			
		<div id="form_1"><h3>Добавить новый элемент</h3>
		<form action="content.php" method="POST">
			<select name="tag">
				<option value="h1">Заголовок</option>
				<option value="p">Новый абзац</option>
				<option value="img">Картинка</option>
				<option value="vid">Видео</option>
				<option value="album">Альбом</option>
				<option value="hr">Разделитель</option>
			<input type="hidden" name="title" value="<?php echo $pageName?>">
			<input type="submit" value="Выбрать"> 
		</form><br></div>
		
		<div id="form_1"><h3>Добавить новый элемент на русском</h3>
		<form action="content.php" method="POST">
			<select name="tag">
				<option value="h1Rus">Заголовок</option>
				<option value="pRus">Новый абзац</option>
				<option value="imgRus">Картинка</option>
				<option value="vidRus">Видео</option>
				<option value="albumRus">Альбом</option>
				<option value="hrRus">Разделитель</option>
				<option value="copyRus">Копия со старого</option>
			<input type="hidden" name="title" value="<?php echo $pageName?>">
			<input type="submit" value="Выбрать"> 
		</form><br></div>
	<?php
			$tag = $content->clearStr($_POST['tag']);
			switch ($tag){
				case "h1":
	?>
						<div id="form_2">
							<form action="saveContent.php" method="POST">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Текст заголовка: <input type="text" name="input"><br>
								Выравнивание:<br>
								<input type="radio" name="align" value="center">По центру<br>
								<input type="radio" name="align" value="left">По левому краю<br>
								<input type="radio" name="align" value="right">По правому краю<br>
								Размер шрифта:<br>
								<input type="radio" name="font-size" value="16px">Маленький<br>
								<input type="radio" name="font-size" value="20px">Средний<br>
								<input type="radio" name="font-size" value="24px">Большой<br>
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>
	<?php
				break;
				case "p":
	?>
							<form action="saveContent.php" method="POST">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Текст абзаца: <br><textarea name="input" cols="30" rows="5"></textarea><br>
								Размер шрифта:<br>
								<input type="radio" name="font-size" value="12px">Маленький<br>
								<input type="radio" name="font-size" value="16px">Средний<br>
								<input type="radio" name="font-size" value="20px">Большой<br>
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "img":
	?>
							<form action="saveContent.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Выравнивание:<br>
								<input type="radio" name="align" value="middle">По центру<br>
								<input type="radio" name="align" value="left">По левому краю<br>
								<input type="radio" name="align" value="right">По правому краю<br>
								Расположение в тексте:<br>
								<input type="radio" name="float" value="false">Отдельно от текста<br>
								<input type="radio" name="float" value="true">Внутри текста<br>
								<input type="file" name="uploaded_image">
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "vid":
	?>
							<form action="saveContent.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Ссылка на видео: <input type="text" name="videoHref"><br><br>
								Заголовок: <input type="text" name="title"><br><br>
								Описание видео: <input type="text" name="descr"><br><br>
								<input type="submit" value="Добавить">
							</form>
	<?php
				break;
				case "hr":
	?>
							<form action="saveContent.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Видимость линии:<br>
								<input type="radio" name="hrWidth" value="border:none">Невидимая<br>
								<input type="radio" name="hrWidth" value="">Видимая<br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "album":
	?>
							<form action="saveContent.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								<select name='albumDir'>
								<?php
								foreach($albumArr as $row){
								?>
								<option value="<?php echo $row['id']?>"><?php echo $row['title']?></option>	
								<?php } ?>	
								</select>
								<input type="submit" value="Добавить">
							</form>	
						</div>
	<?php
				break;
				case "h1Rus":
	?>						
							<form action="saveContentRus.php" method="POST">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Текст заголовка: <input type="text" name="input"><br>
								Выравнивание:<br>
								<input type="radio" name="align" value="center">По центру<br>
								<input type="radio" name="align" value="left">По левому краю<br>
								<input type="radio" name="align" value="right">По правому краю<br>
								Размер шрифта:<br>
								<input type="radio" name="font-size" value="16px">Маленький<br>
								<input type="radio" name="font-size" value="20px">Средний<br>
								<input type="radio" name="font-size" value="24px">Большой<br>
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>
	<?php
				break;
				case "pRus":
	?>
							<form action="saveContentRus.php" method="POST">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Текст абзаца: <br><textarea name="input" cols="30" rows="5"></textarea><br>
								Размер шрифта:<br>
								<input type="radio" name="font-size" value="12px">Маленький<br>
								<input type="radio" name="font-size" value="16px">Средний<br>
								<input type="radio" name="font-size" value="20px">Большой<br>
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "imgRus":
	?>
							<form action="saveContentRus.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Выравнивание:<br>
								<input type="radio" name="align" value="middle">По центру<br>
								<input type="radio" name="align" value="left">По левому краю<br>
								<input type="radio" name="align" value="right">По правому краю<br>
								Расположение в тексте:<br>
								<input type="radio" name="float" value="false">Отдельно от текста<br>
								<input type="radio" name="float" value="true">Внутри текста<br>
								<input type="file" name="uploaded_image">
								Ссылка: <input type="text" name="href"><br><br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "vidRus":
	?>
							<form action="saveContentRus.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Ссылка на видео: <input type="text" name="videoHref"><br><br>
								Заголовок: <input type="text" name="title"><br><br>
								Описание видео: <input type="text" name="descr"><br><br>
								<input type="submit" value="Добавить">
							</form>
	<?php
				break;
				case "hrRus":
	?>
							<form action="saveContentRus.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								Видимость линии:<br>
								<input type="radio" name="hrWidth" value="border:none">Невидимая<br>
								<input type="radio" name="hrWidth" value="">Видимая<br>
								<input type="submit" value="Добавить">
							</form>	
	<?php
				break;
				case "albumRus":
	?>
							<form action="saveContentRus.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								<select name='albumDir'>
								<?php
								foreach($albumArr as $row){
								?>
								<option value="<?php echo $row['id']?>"><?php echo $row['titleRus']?></option>	
								<?php } ?>	
								</select>
								<input type="submit" value="Добавить">
							</form>	
						</div>
	<?php
				break;
				case "copyRus":
	?>
							<form action="saveContentRus.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="id" value="<?php echo $id?>">
								<input type="hidden" name="tag" value="<?php echo $tag?>">
								Порядковый номер: <input type="text" name="id"><br>
								<input type="submit" value="Скопировать">
							</form>	
						</div>
	<?php					
			}
	?>
	
	<ul>
<?php
		$res = $content->getDivs($pageName);
		if (!is_array($res)){
			$errMsg = "Произошла ошибка при выводе содержимого страницы";
		}elseif ($res == false)
			$errMsg = "Страница пуста";
		else{
			foreach($res as $row){
?>		
		<div class="content"><li><?php echo $row['id']?>. <?php echo  $row['content']?> <br> <?php echo  $row['contentRus']?> <a href="deleteDiv.php?id=<?php echo $row['id']?>&pageName=<?php echo $pageName?>">Удалить</a></li></div>
	<?php
			}
		}
			echo "</ul>";
			echo $errMsg;
			//$arr = getimagesize('../pics/pagePics/Our_store.jpg');
			//print_r ($arr);
	?>
</body>
</html>	