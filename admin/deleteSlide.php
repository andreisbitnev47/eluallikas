<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
	}
$slider = new slider;
$id = $slider->clearStr($_GET['id']);
if($id){
	if(!$slider->deleteSlide($id))
		echo 'Произошла ошибка при удалении слайда';
	else{
		header('Location: slider.php');
		exit;
	}
}
?>