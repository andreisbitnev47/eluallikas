<div id="bottom">
			<ul>
			<?php
				
				foreach ($block as $row){
			?>
			<li>
				<div class = "block">
					<a href="<?php echo $_SERVER['PHP_SELF']?>?id=bl<?php echo $row['id']?>"><img src="pics/blocks/<?php echo unserialize($row['img'])?>" alt="block_1" title="block_1" href="#"></a><br>
					<h2><a href="<?php echo $_SERVER['PHP_SELF']?>?id=bl<?php echo $row['id']?>"><?php echo $row['title']?></a><h2>
					<p><a href="<?php echo $_SERVER['PHP_SELF']?>?id=bl<?php echo $row['id']?>"><?php echo $row['descr']?></a></p>
				</div>
			</li>
			<?php }?>
		</div>