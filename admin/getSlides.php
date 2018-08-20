<?php
	$slides = $slider->getSlides();
	if (!is_array($slides))
		$errMsg = "Произошла ошибка при выводе слайдов";
	elseif (!$slides)
		$errMsg = "Не добавлено ни одного слайда";
?>
<ul>
<?php
	foreach ($slides as $slide){
	$dt = date('d-m-Y H:i:s', $slide['datetime']);
?>
<li><h3><?php echo $slide['id']?> </h3>
<img src="../pics/slides/<?php echo unserialize($slide['title'])?>" 
alt="slide #<?php echo $slide['id']?>"
width="480px"
height="200px"><br>
<h3>Слайд: <?php echo unserialize($slide['title'])?> добавлен <?php echo $dt?></h3><br>
<a href="deleteSlide.php?id=<?php echo $slide['id']?>"><h3>Удалить</h3><a></li>
<?php
	}
?>
</ul>