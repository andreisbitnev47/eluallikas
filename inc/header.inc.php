<header>
			<div id="headerTop">
				<img src="pics/sammudlogo.png" 
					alt="logo" 
					href="sammud.ee" 
					title="logo">
					<? if($lang=='rus'){?>
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
					<div>info@eluallikas.ee</div>
				</section>
					<? }else{ ?>
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
					<div>info@eluallikas.ee</div>
				</section>
					<? } ?>
			</div>
			<div class="width">
				<nav>
					<ul>
						<?
							if (!is_array($navDir))
								$errMsg = "Ошибка при выводе меню";
							foreach ($navDir as $row){
								if ($lang == "rus"){
						?>
									<li><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$navigation->addBlanks($row['titleRus'])?></a></li>
						<?
								}else{
						?>
									<li><a href="<?=$_SERVER['PHP_SELF']?>?id=<?=$row['id']?>"><?=$navigation->addBlanks($row['title'])?></a></li>
						<?			
								}
							}
							
						?>
					</ul>
					<div id='est'>
						<a href="<?= $_SERVER['PHP_SELF']?>?id=<?=$id?>&lang=est"><img src="pics/flags/est.png"></a>
					</div>
					<div id='rus'>
						<a href="<?= $_SERVER['PHP_SELF']?>?id=<?=$id?>&lang=rus"><img src="pics/flags/rus.png"></a>
					</div>
				</nav>
			</div>
		</header>