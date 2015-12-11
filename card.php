<?
	include_once "base.php";
	top("Корзина");
	session_start();
	$a = $_REQUEST['al'];
	if(!$_SESSION['hash'])
		echo "Корзина пуста!";
	else
		header("Location:/".$_SESSION['hash']. ($a ? "?al=1" : ""));
	bottom();
?>