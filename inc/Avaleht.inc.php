		<div id="slideshow">
			<img src="pics/slides/slider-1.jpg">
			<!--<nav>
				<div id="left-arrow"><a href="<?=$_SERVER['PHP_SELF']?>?dir=left"></a></div>
				<div id="right-arrow"><a href="<?=$_SERVER['PHP_SELF']?>?dir=right"></a></div>
			</nav>-->
		</div>
			<div id="lozung">
				<? if($lang=='rus'){?>
				<p>Начни первые шаги в новую жизнь вместе с нами</p>
				<? }else{ ?>
				<p>Alusta oma esimesed sammud meiega</p>
				<? } ?>
			</div>
	</div>
</div>
<div id="bottom">
	<div id="bottomBackground">
			<ul>
			<?
				
				foreach ($block as $row){
					if($lang=="rus"){
			?>
			<li>
				<div class = "block">
					<a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>">
					<img src="pics/blocks/<?=unserialize($row['img'])?>" 
						alt="block_<?=$row['id']?>" 
						title="block_<?=$row['id']?>"></a><br>
					<h2><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$content->addBlanks($row['titleRus'])?></a><h2>
					<p><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$row['descrRus']?></a></p>
				</div>
			</li>
			<?}else{?>
				<li>
				<div class = "block">
					<a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>">
					<img src="pics/blocks/<?=unserialize($row['img'])?>" 
						alt="block_<?=$row['id']?>" 
						title="block_<?=$row['id']?>"></a><br>
					<h2><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$content->addBlanks($row['title'])?></a><h2>
					<p><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$row['descr']?></a></p>
				</div>
			</li>
				<? } } ?>