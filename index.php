<?php 
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include 'classes/'. $class . '.class.php';	
}
session_start();
$content = new content;
$navigation = new nav;
$navDir = $navigation->getDir();
$blocks = new blocks;
$block = $blocks->getBlocks();
$albums = new album;
$fotos = new fotos;
$errMsg='';
$id = $_SESSION['id'];
$lang = $_SESSION['lang'];
if ($_SERVER[REQUEST_METHOD]=='GET'){
								if (!$_GET['id'])
									$id = $_SESSION['id'];
								else{
									$id = $navigation->clearStr($_GET['id']);
									$_SESSION['id'] = $id;
								}	
								if (!$_GET['lang'])
									$lang = $_SESSION['lang'];
								else{
									$lang = $navigation->clearStr($_GET['lang']);
									 $_SESSION['lang'] = $lang;
								}	
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sammud vabadusse</title>
		<link rel="stylesheet" type="text/css" href="style.css" media="screen">
		<style>
		</style>
		
	</head>
	<body>
		<?
		require ('inc/header.inc.php');
		
		?>
			<div id="pageBody">
				<div id="pageBackground">
				<?= $errMsg;
					if ($_SERVER[REQUEST_METHOD]=='GET'){
								$navDir = $navigation->getOneDir($id);
								$blockDir = $blocks->getOneDir($id);
								$albumDir = $albums->getOneDir($id);
								$fotoDir = $fotos->getOneDir($id);
							}
						switch ($id){
							case '':
								$dirTitle = 'Avaleht';
								break;
							case $navDir['0']['id']:
								$dirTitle = $navDir['0']['title'];
								break;
							case $blockDir['0']['id']:
								$dirTitle = $blockDir['0']['id'];
								break;
							case $albumDir['0']['id']:
								$dirTitle = $albumDir['0']['id'];
								break;
							case $fotoDir['0']['id']:
								$dirTitle = $fotoDir['0']['id'];
								$albumArr = $fotos->fotoArr($id); //получаю ассоциативный массив с id фотографий в альбоме
								foreach($albumArr as $row){ //пределываю массив в простой, для использования в javascript
									$fotoArr[]=$row['id'];
								}
								break;
							default:
								$dirTitle = 'Avaleht';
								break;
						}
						
						$divs = $content->getDivs($dirTitle);
						foreach ($divs as $div){
							if ($lang == "rus")
								echo $div['contentRus'];
							else
								echo $div['content'];
						}
						if ($dirTitle == 'Avaleht')
							require ('inc/Avaleht.inc.php');
				?>
				</div>
			</div>
		<?
		require ('inc/footer.inc.php')
		?>
		<form id="fotoSlider" action="<?=$_SERVER['PHP_SELF']?>" method='GET'><!--форма для переключения фотографий в альбоме через script-->
			<input type="hidden" name='id' value="<?=$id?>">
		</form>
		<script type="text/javascript">
		function slider(){
			var input1 = document.getElementById('fotoSlider').getElementsByTagName('input')[0];
			var fullId = input1.getAttribute('value');
			var jArr= <?php echo json_encode($fotoArr); ?>; //массив фоток альбома
			var id;
			for (var i=0; i<jArr.length; i++){
				if (jArr[i]==fullId && i<(jArr.length-1)){
					id = jArr[i+1];
					console.log(id);
					break;
				}else if (jArr[i]==fullId && i==(jArr.length-1)){
					id = jArr[0];
					console.log(id);
					break;
				}
			}
			input1.setAttribute('value', id)
			document.getElementById('fotoSlider').submit();
		}
		</script>
	</body>
</html>