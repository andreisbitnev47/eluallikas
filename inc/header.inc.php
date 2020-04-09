<header>
			<div id="headerTop">
				<img src="pics/sammudlogo.png" 
					alt="logo" 
					href="sammud.ee" 
					title="logo">
					<?php if($lang=='rus'){?>
					<section>
					Начни новую жизнь<br>
					<div>с Богом</div>
				</section>
				<section>
					Твоя свобода<br>
					<div>в твоих руках</div>
				</section>
				<section>
					Свяжись с нами<br>
					<div class="email">eluallikas@gmail.com</div>
				</section>
					<?php }else{ ?>
				<section>
					Alusta uus elu<br>
					<div>Jumalaga</div>
				</section>
				<section>
					Sinu vabadus<br>
					<div>on sinu kaes</div>
				</section>
				<section>
					Võta ühendust<br>
					<div class="email">eluallikas@gmail.com</div>
				</section>
					<?php } ?>
			</div>
			<div class="width">
				<nav>
					<ul>
						<?php
							if (!is_array($navDir))
								$errMsg = "Ошибка при выводе меню";
							foreach ($navDir as $row){
								if ($lang == "rus"){
						?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $navigation->addBlanks($row['titleRus'])?></a></li>
						<?php
								}else{
						?>
									<li><a href="<?php echo $_SERVER['PHP_SELF']?>?id=<?php echo $row['id']?>"><?php echo $navigation->addBlanks($row['title'])?></a></li>
						<?php			
								}
							}
							
						?>
					</ul>
					<div id='est'>
						<a href="<?php echo  $_SERVER['PHP_SELF']?>?id=<?php echo $id?>&lang=est"><img src="pics/flags/est.png"></a>
					</div>
					<div id='rus'>
						<a href="<?php echo  $_SERVER['PHP_SELF']?>?id=<?php echo $id?>&lang=rus"><img src="pics/flags/rus.png"></a>
					</div>
				</nav>
			</div>
		</header>