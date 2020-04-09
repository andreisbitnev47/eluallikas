<?php
	header('Content-Type: text/html; charset=utf-8');
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$content = new content;
	$albums = new album;
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$tag=$content->clearStr($_POST['tag']);
		$pageName=$content->clearStr($_POST['pageName']);
		$id=$content->clearInt($_POST['id']);
		$input=$content->clearStr($_POST['input']);
		$hrWidth=$content->clearStr($_POST['hrWidth']);
		$align=$content->clearStr($_POST['align']);
		$fontSize=$content->clearStr($_POST['font-size']);
		$float=$content->clearStr($_POST['float']);
		$href=$content->clearStr($_POST['href']);
		$title=$content->clearStr($_POST['title']);
		$descr=$content->clearStr($_POST['descr']);
		$src=$content->clearStr($_POST['src']);
		$albumDir=$content->clearStr($_POST['albumDir']);
		$videoHref=$_POST['videoHref'];
		preg_match('/\d{3}/',$videoHref , $width);//поиск ширины видео в iframe, которым задана ссылка на youtube.
		$videoWidth = $width[0]; 
		if (!$href){
			$a = '';
			$aClose = '';
		}else{
			$a = "<a href=\"$href\">";
			$aClose = '</a>';
		}	
		if ($tag == "imgRus"){
			$tmp = $_FILES['uploaded_image']['tmp_name'];
			$name = $_FILES['uploaded_image']['name'];
			move_uploaded_file($tmp, '../pics/pagePics/'.$name);
			$src = 'http://sammudvabadusse.ee/pics/pagePics/'.$name;
			$imgParam = getImagesize ("http://sammudvabadusse.ee/pics/pagePics/$name");
			$width = $imgParam[0];
			if ($width > 950){
				$width = 950;
				$ratio = $width/$imgParam[0];
				$height = $imgParam[1]*$ratio;
			}else{
				$width =$width;	
				$height = $imgParam[1];
			}
			$height = $height.'px';
			$width = $width.'px';
			if ($align == 'middle'){
				$div = "<div id='pageImg' style='width:$width; height:$height; margin: 16px auto;'>";
				$divClose = "</div>";
				$align = '';
			}else{
				$div = "";
				$divClose = "";
			}
			if ($float == 'true')
				$float = "float:$align";
			else 
				$float = '';
		}
		switch ($tag){
			case "h1Rus": $finInput = $a.'<h1 style=\'text-align:'.$align.'; font-size:'.$fontSize.'\'>'.$input.'</h1>'.$aClose; break;
			case "pRus": $finInput = $a.'<p style=\'font-size:'.$fontSize.'\'>'.$input.'</p>'.$aClose; break;
			case "imgRus": $finInput = $a.$div.'<img width=\''.$width.'\' height=\''.$height.'\' style=\''.$float.'\' src=\''.$src.'\'>'.$divClose.$aClose; break;
			case "vidRus": $finInput = '<div class=\'vid\' style=\'width:'.$videoWidth.'px;\'><h3>'.$title.'</h3>'.$videoHref.'<p>'.$descr.'</p></div>';break;
			case "hrRus": $finInput = '<hr style=\'clear:both;'.$hrWidth.'\'>';break;
			case "albumRus": $oneAlbum = $albums->getOneDir($albumDir);
							$title = $oneAlbum[0]['titleRus'];
							$src = $oneAlbum[0]['src'];
							$finInput = '<a href=\'http://sammudvabadusse.ee/index.php?id='.$albumDir.'\'><div class=\'album\'><h3>'.$title.'</h3><div class=\'albumFront\' style=\'background-image: url('.$src.');background-size:cover\'></div></div></a>';break;
			case "copyRus": $finInput = $content->getContentById($id, $pageName);break;
		}
		$finInput = $content->escapeStr($finInput);
		$res=$content->saveContentRus($id, $finInput, $pageName);
		
		
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при добавлении информации';
		}
		else{
			header ("Location: content.php?title=$pageName");
		}
		//echo $res;
	}
?>