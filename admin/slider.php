<?
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$slider = new slider;
$errMsg="";
if($_SERVER['REQUEST_METHOD']=='POST'){
		//print_r($_FILES);
		$tmp = $_FILES['user_file']['tmp_name'];
		$name = $_FILES['user_file']['name'];
		move_uploaded_file($tmp, '../pics/slides/'.$name);
		$name = serialize($name);
		$slider->addSlide($name);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Слайдер</title>
	</head>
	<body>
		<h1>Картинки слайдера</h1>
<?
	include "getSlides.php";
	echo $errMsg;
?>
		<br>
		<form action='slider.php' method='post' enctype='multipart/form-data'>
		<input type='file' name='user_file'>
		<input type='submit'>
		</form>
		<br>
		<br>
	</body>
</html>