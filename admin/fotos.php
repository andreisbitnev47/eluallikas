<?php
	header('Content-Type: text/html; charset=utf-8');
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$content = new content;
	$fotos = new fotos;
?>
<!DOCTYPE html>
<html>
	
<?php	
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$pageName = $content->clearStr($_POST['title']);
		$id = $content->clearStr($_POST['id']);
	}
	if ($_SERVER[REQUEST_METHOD]=='GET'){
		$pageName = $content->clearStr($_GET['title']);
		$id = $content->clearStr($_GET['id']);
	}

?>
		<head>
			<title>Редактор альбома <?php echo $pageName?></title>
			<style>
				body {width: 1000px;
					background: white;
				}
				.content, #form_1, #form_2 {width: 960px;
						margin: 20px;
						float:left;
				}
				.albumFoto {width: 250px; height:250px;}
			</style>
		</head>
		<body>
			<h1>Фотографии альбома "<?php echo $pageName?>"</h1>
			<a href='albums.php'>Назад к альбомам</a><br>
			
			<div id="form_1"><h3>Добавить новую фотографию</h3>
							<form action="saveFotos.php" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="pageName" value="<?php echo $pageName?>">
								<input type="hidden" name="pageId" value="<?php echo $id?>">
								Заглавие : <input type="text" name="title"><br>
								Заглавие рус: <input type="text" name="titleRus"><br>
								Краткое описание/комментарий: <input type="text" name="descr"><br>
								Краткое описание/комментарий рус: <input type="text" name="descrRus"><br>
								<input type="file" name="uploaded_image">
								<input type="submit" value="Добавить">
							</form>	
							<br>
			</div>
			<ul>
<?php
		$res = $content->getDivs($id);
		if (!is_array($res)){
			$errMsg = "Произошла ошибка при выводе содержимого страницы";
		}elseif ($res == false)
			$errMsg = "Альбом пуст";
		else{
			foreach($res as $row){
?>		
		<div class="content"><li><?php echo $row['id']?>. <?php echo $row['content']?><a href="deleteFoto.php?id=<?php echo $row['id']?>&pageName=<?php echo $pageName?>&pageId=<?php echo $id?>">Удалить</a></li></div>
	<?php
			}
		}
			echo "</ul>";
			echo $errMsg;
	?>
							
	
</body>
</html>	