<div id="bottom">
			<ul>
			<?
				
				foreach ($block as $row){
			?>
			<li>
				<div class = "block">
					<a href="<?=$_SERVER['PHP_SELF']?>?id=bl<?=$row['id']?>"><img src="pics/blocks/<?=unserialize($row['img'])?>" alt="block_1" title="block_1" href="#"></a><br>
					<h2><a href="<?=$_SERVER['PHP_SELF']?>?id=bl<?=$row['id']?>"><?=$row['title']?></a><h2>
					<p><a href="<?=$_SERVER['PHP_SELF']?>?id=bl<?=$row['id']?>"><?=$row['descr']?></a></p>
				</div>
			</li>
			<?}?>
		</div>