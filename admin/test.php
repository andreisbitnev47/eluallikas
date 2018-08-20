<?php
function __autoload($class){
		include '../classes/'. $class . '.class.php';
}
$content = new content;
$res = $content->getPicName('3', 'asd');
print_r($res);
?>