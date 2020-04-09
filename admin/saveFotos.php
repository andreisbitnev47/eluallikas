<?php
	header('Content-Type: text/html; charset=utf-8');
	function __autoload($class){
			include '../classes/'. $class . '.class.php';
	}
	$errMsg = '';
	$content = new content;
	$albums = new album;
	$fotos = new fotos;
	if ($_SERVER[REQUEST_METHOD]=='POST'){
		$pageName=$content->clearStr($_POST['pageName']);
		$pageId=$content->clearStr($_POST['pageId']);
		$tempId = $pageId.'_'; //temporary id to get the last added photo id from the catalog
		$lastId = $fotos->fotoCnt($tempId);
		$lastId = $content->clearInt($lastId);
		if ($lastId<9){
			$idNum = $lastId + 1;
			$idNum = '0'.$idNum;
		}else{
			$idNum = $lastId + 1;
		}
		$id = $pageId.'_'.$idNum;
		$title=$content->clearStr($_POST['title']);
		$descr = $content->clearStr($_POST['descr']);
		$titleRus=$content->clearStr($_POST['titleRus']);
		$descrRus = $content->clearStr($_POST['descrRus']);
		
		$tmp = $_FILES['uploaded_image']['tmp_name'];
		$name = $_FILES['uploaded_image']['name'];
		move_uploaded_file($tmp, '../pics/fotos/'.$name);
		$src = 'http://sammudvabadusse.ee/pics/fotos/'.$name;
		$imgParam = getImagesize ("http://sammudvabadusse.ee/pics/fotos/$name");
		$w= $imgParam[0];
		if ($w > 900) //image max-width in css is set to 900 px
			$w = 900;
		$width= $w.'px';
		$height = $imgParam[1].'px';
		$res = $content->createDirDB($id);
		$clearSrc = $content->escapeStr('../pics/fotos/'.$name); //путь к фотке для записи в каталог (fotos)
		if (!$res ){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении директории database $id";
			exit;
		}
		$res = $fotos->addDir($clearSrc, $id); //добавляем новый элемент в таблицу fotos
		if (!$res ){
			header('Content-Type: text/html; charset=utf-8');
			echo "Произошла ошибка при добавлении фотографии $id в таблицу fotos";
			exit;
		}
		
		$finInput = '<a href=\'http://sammudvabadusse.ee/index.php?id='.$id.'\'><div class=\'albumFoto\' style=\'background-image: url(http://sammudvabadusse.ee/pics/fotos/'.$name.'); background-size:cover;\'></div></a>';//отображение на странице альбома
	
		$finInput = $content->escapeStr($finInput);
		$res=$content->saveContent($id, $finInput, $pageId);
		
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при добавлении информации в альбом id='.$id.'pagename='.$pageId;
			exit;
		}
		$res=$content->saveContentRus($id, $finInput, $pageId);
		
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при добавлении информации в альбом id='.$id.'pagename='.$pageId;
			exit;
		}
		$finInput = '<div class=\'foto\' style=\'width:'.$width.'\'><h2>'.$title.'</h2><a href=\'javascript:slider()\'><img src=\'http://sammudvabadusse.ee/pics/fotos/'.$name.'\'></a><p>'.$descr.'</p></div>';//отображение фотки 
		$finInput = $content->escapeStr($finInput);
		$res=$content->saveContent($id , $finInput, $id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при добавлении информации в таблицу самой фотографии';
			exit;
		}else{
			header ("Location: fotos.php?title=$pageName&id=$pageId");
		}
		$finInput = '<div class=\'foto\' style=\'width:'.$width.'\'><h2>'.$titleRus.'</h2><a href=\'javascript:slider()\'><img src=\'http://sammudvabadusse.ee/pics/fotos/'.$name.'\'></a><p>'.$descrRus.'</p></div>';//отображение фотки 
		$finInput = $content->escapeStr($finInput);
		$res=$content->saveContentRus($id , $finInput, $id);
		if (!$res){
			header('Content-Type: text/html; charset=utf-8');
			echo 'Произошла ошибка при добавлении информации в таблицу самой фотографии';
			exit;
		}else{
			header ("Location: fotos.php?title=$pageName&id=$pageId");
		}
	}
?>