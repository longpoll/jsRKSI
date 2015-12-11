<!DOCTYPE html>
	<head>
		<meta charset="utf-8"/>
		<title>title</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script>
			console.log(0);
			$(window).load(function(){
				console.log(0);
				$("#loader").fadeOut(500,function(){
					console.log(0);
					$("header").fadeIn(400, function(){
						console.log(0);
						$("main").fadeIn(500);
						$("menu").fadeIn(500);
						$("footer").fadeIn(500);
					});
				});
			});
		</script>
		<style>
			main, menu, header, footer{
				display: none;
			}
			*{
				margin:0;
				padding:0;
			}
			body{
				background:url('fon.png') no-repeat #aac9dc;
				background-size:cover;
				background-attachment:fixed;
				font-family:'Verdana';
			}
			header{
				max-width:1000px;
				margin: 50px auto;
			}
			header img{
				max-width: 1000px;
			}
			#content{
				width:1000px;
				margin:0 auto;
				overflow:hidden;
			}
			main{
				width:750px;
				float:right;
			}
			menu{
				float: left;
				width:200px;
				position:fixed;
			}
			menu, main{
				background: #5D913C;
				border:6px solid white;
				color:white;
				box-shadow:0 0 2px #fff;
				border-radius: 8px;
				padding:5px;
			}
			/*#loader{
				width:100%;
				height: 100%;
				background: black;
				color:white;
				text-align:center;
				line-height:100%;
				position:fixed;
			}*/
			footer .text{
				background: #5D913C;
				border:6px solid white;
				color:white;
				box-shadow:0 0 2px #fff;
				border-radius: 8px;
				padding:5px;
			}
			footer{
				text-align:center;
				margin:20px auto;
				color: white;
				width:1000px;
			}
		</style>
	</head>
	<body>
		<div id="loader"></div> <!-- DIV ДЛЯ ИНДИКАТОРА ЗАГРУЗКИ -->
		<div id="content">
			<header><img src='logo.png' alt='logo'/></header>
			<menu>sidebar</menu>
			<main>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/></main>
		</div>
		<footer><span class="text">FOOTER</span></footer>
	</body>
</html>