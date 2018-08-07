<?
	$slides = $slider->getSlides();
	if (!is_array($slides))
		$errMsg = "Произошла ошибка при выводе слайдов";
	elseif (!$slides)
		$errMsg = "Не добавлено ни одного слайда";
?>
<ul>
<?
	foreach ($slides as $slide){
	$dt = date('d-m-Y H:i:s', $slide['datetime']);
?>
<li><h3><?=$slide['id']?> </h3>
<img src="../pics/slides/<?=unserialize($slide['title'])?>" 
alt="slide #<?=$slide['id']?>"
width="480px"
height="200px"><br>
<h3>Слайд: <?=unserialize($slide['title'])?> добавлен <?=$dt?></h3><br>
<a href="deleteSlide.php?id=<?=$slide['id']?>"><h3>Удалить</h3><a></li>
<?
	}
?>
</ul>