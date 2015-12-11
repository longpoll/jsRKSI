<?
	include_once "base.php";
	if(!$_GET['url']){
		top("Главная");
		$d = SQL("SELECT * FROM `js_catalog`");
?>
	<form action="order.php" method="post" onsubmit="return newOrder(this, event)">
		<table>
	<?
		for($i = 0; $i < sizeof($d); $i++){
			$t = $d[$i];
	?>
			<tr>
				<td class="small"><img src="<?=$t['image']?>" onclick="return resizeImg(this.src)"></td>
				<td class="big <?=($i%2?'black':'white')?>"><?=$t['title']?></td>
				<td class="small"><?=$t['price']?>₽</td>
				<td class="small"><input class="number" name="number[]" value="0" type="number" min="0" max="20" step="1" /></td>
			</tr>
	<?
		}
	?>
		</table>
		<input type="submit" value="Сделать заказ"/>
	</form>
<?
		bottom();
	}else{
		top("Просмотр заказа");
		$a 		= SQL("SELECT * FROM `js_card` WHERE `hash`='".$_GET['url']."'")[0];
		$cId 	= explode(",", $a['cId']);
		$count	= explode(",", $a['count']);
		$c 		= 0;
		$query 	= "SELECT * FROM `js_catalog` WHERE 1!=1";

		for ($i = 0; $i < sizeof($cId); $i++)
			$query .= " OR `cId`=".$cId[$i];
		$d 		= SQL($query);
?>
	<div class="about">Имя: <?=$a['first_name'];?></div>
	<div class="about">Фамилия: <?=$a['last_name'];?></div>
	<div class="about">Адрес: <?=$a['address'];?></div>
		<table>
	<?
		for($i = 0; $i < sizeof($d); $i++){
			$t 		= $d[$i];
			$c 		+= $count[$i];
			$sum 	+= $count[$i]*$t['price'];
	?>
			<tr>
				<td class="small"><img src="<?=$t['image']?>"></td>
				<td class="big <?=($i%2?'black':'white')?>"><?=$t['title']?></td>
				<td class="small"><?=$count[$i]?></td>
			</tr>
	<?
		}
	?>
		<tr class="black">
			<td class="small">Итого: </td>
			<td class="big"><?=$c?>шт.</td>
			<td class="small"><?=$sum?>₽</td>
		</tr>
		</table>

<?
		bottom();
	}
?>