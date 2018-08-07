<?
header('Content-Type: text/html; charset=utf-8');
function __autoload($class){
		include 'classes/'. $class . '.class.php';
	}
?>
