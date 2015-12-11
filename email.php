<?
	include_once "base.php";
	session_start();
	$p 					= $_POST;
	$cIdE 				= explode(",", $p['cId']);
	$countE 			= explode(",", $p['count']);
	$cId 				= $p['cId'];
	$count 				= $p['count'];
	$email 				= $p['email'];
	$hash 				= generateCode(32);
	$_SESSION['hash'] 	= $hash;
	$first_name 		= $p['first_name'];
	$last_name 			= $p['last_name'];
	$address			= $p['address'];
	$query = "SELECT * FROM `js_catalog` WHERE 1!=1";
	for ($i = 0; $i < sizeof($cIdE); $i++)
		$query .= " OR `cId`=".$cIdE[$i];
	$d = SQL($query);
	SQL("INSERT INTO `js_card`(`cId`, `count`, `hash`, `email`, `first_name`, `last_name`, `address`) VALUES ('".$cId."', '".$count."', '".$hash."', '".$email."', '".$first_name."', '".$last_name."', '".$address."')");

	$m = '<a href="http://js.apicat.ru/'.$hash.'">Перейти к заказу</a>';
	$m .= '<br/>Имя: '.$first_name;
	$m .= '<br/>Фамилия: '.$last_name;
	$m .= '<br/>Адрес: '.$address;

	$to = $email; 
	$text = $m;

	$subject = "Заказ оформлен!";
	$from_name = "webmaster@apicat.ru";

	$dc = "UTF-8";
	$sc = "windows-1251";

	$enc_to = mime_header_encode($to,$dc,$sc).' <'.$to.'>';
	$enc_subject = mime_header_encode($subject,$dc,$sc);
	$enc_from = mime_header_encode($from_name,$dc,$sc).' <'.$from_name.'>';

	$enc_body = ($dc == $sc ? $text : iconv($dc,$sc.'//IGNORE',$text) );

	$headers = "Mime-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=windows-1251\r\n";
	$headers .= "From: ".$enc_from."\r\n";

	mail($enc_to, $enc_subject ,$enc_body, $headers);

	header("Location: /".$hash);
?>		