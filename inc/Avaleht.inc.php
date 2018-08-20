		<div id="slideshow">
			<img src="pics/slides/slider-1.jpg">
			<!--<nav>
				<div id="left-arrow"><a href="<?php echo $_SERVER['PHP_SELF']?>?dir=left"></a></div>
				<div id="right-arrow"><a href="<?php echo $_SERVER['PHP_SELF']?>?dir=right"></a></div>
			</nav>-->
		</div>
			<div id="lozung">
				<?php if($lang=='rus'){?>
				<p>Начни первые шаги в новую жизнь вместе с нами</p>
				<?php }else{ ?>
				<p>Alusta oma esimesed sammud meiega</p>
				<?php } ?>
			</div>
	</div>
</div>
<div id="bottom">
	<div id="bottomBackground">
			<ul>
			<?php
				foreach ($block as $row){
					if($lang=="rus"){
			?>
			<li>
				<div class = "block">
					<a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>">
					<img src="pics/blocks/<?php echo unserialize($row['img'])?>" 
						alt="block_<?php echo $row['id']?>" 
						title="block_<?php echo $row['id']?>"></a><br>
					<h2><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $content->addBlanks($row['titleRus'])?></a><h2>
					<p><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $row['descrRus']?></a></p>
				</div>
			</li>
			<?php } else { ?>
				<li>
				<div class = "block">
					<a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>">
					<img src="pics/blocks/<?php echo unserialize($row['img'])?>" 
						alt="block_<?php echo $row['id']?>" 
						title="block_<?php echo $row['id']?>"></a><br>
					<h2><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $content->addBlanks($row['title'])?></a><h2>
					<p><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $row['descr']?></a></p>
				</div>
			</li>
				<?php } } ?>