<?
	header("Content-type:text/html;charset=utf-8");
	session_start();
	function generateCode($length) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  
		while (strlen($code) < $length)
			$code .= $chars[mt_rand(0,$clen)];  
		return $code;
	}
	function mime_header_encode($str, $data_charset, $send_charset){
		if($data_charset != $send_charset)
			$str=iconv($data_charset,$send_charset.'//IGNORE',$str);
		return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
	}
	function BD(){
		$mysqli = mysqli_connect("localhost", "user", "table_code", "rsopyfnf_code");      		
    	if(!$mysqli)
      		exit('Невозможно подключиться к MySQLi серверу!');
    	return $mysqli;
    }
   	function SQL($query){
    	$connect = BD();
      	mysqli_query($connect,"SET NAMES UTF8");
      	$response = mysqli_query($connect,$query);
      	$data = array();
      	if($response){
	      	while($result = @mysqli_fetch_assoc($response))
	        	$data[]=$result;
	    }
	    mysqli_close($connect);
      	return $data;
    }
    function top($title){
    	if( !$_REQUEST['al'] ) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<title><?=$title?></title>
		<link href="/styles/formstyler.css" rel="stylesheet" type="text/css"/>
		<link href="/styles/jquery-ui.min.css" rel="stylesheet" type="text/css"/>
		<link href="/styles/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
		<link href="/styles/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>
		<link href="/styles/styles.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="/js/jquery-ui.min.js"></script>
		<script src="/js/formstyler.js"></script>
		<script src="/js/script.js"></script>
	</head>
	<body>
		<header>
			<div class="content">
				<div class="containerRight">
					<div class="container">
						<a href="/card.php" onclick="return nav(this);"><span>Корзина</span></a>
					</div>
				</div>
				<div class="containerLeft">
					<a href="/" onclick="return nav(this);"><span class="logo">Интернет-магазин</span></a>
				</div>
			</div>
		</header>
		<div id="content" class="loader">
			<div class="loader">
				<div class="ajaxload"></div>
			</div>
		</div>
		<div id="content">
<?
		}
    }
    function bottom(){
    	if( !$_REQUEST['al'] ) {
?>
		</div>
	</body>
</html>
<?
		}
    }
?>