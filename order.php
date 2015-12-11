<?
	include_once "base.php";
	top("Подтверждение заказа");
	$p = $_POST['number'];
	$c = [];
	$v = [];

	$count 	= 0;
	$sum 	= 0;

	for ($i = 0; $i < sizeof($p); ++$i){
		if($p[$i] != "0"){
			$c[] = ($i+1);
			$v[] = $p[$i];
		}
	}
	if(!$c){
		echo 'Товары для заказа не выбраны!';
		return 0;
	}
	$query = "SELECT * FROM `js_catalog` WHERE 1!=1";
	for ($i = 0; $i < sizeof($c); $i++)
		$query .= " OR `cId`=".$c[$i];
	$d = SQL($query);
?>
	<form action="email.php" method="post">
		<input type="hidden" name="cId" value="<?=implode(',', $c)?>"/>
		<input type="hidden" name="count" value="<?=implode(',', $v)?>"/>
		<table>
	<?
		for($i = 0; $i < sizeof($d); $i++){
			$t 		= $d[$i];
			$count 	+= $v[$i];
			$sum 	+= $v[$i]*$t['price'];
	?>
			<tr>
				<td class="small"><img src="<?=$t['image']?>"></td>
				<td class="big <?=($i%2?'black':'white')?>"><?=$t['title']?></td>
				<td class="small"><?=$v[$i]?></td>
			</tr>
	<?
		}
	?>
		<tr class="black">
			<td class="small">Итого: </td>
			<td class="big"><?=$count?>шт.</td>
			<td class="small"><?=$sum?>₽</td>
		</tr>
		</table>
		<div class="email">
			<div>Если всё верно - введите почту</div>
			<input placeholder="Введите имя" class="styler" type="text" name="first_name" required/>
			<input placeholder="Введите фамилию" class="styler" type="text" name="last_name" required/>
			<input placeholder="Введите адрес доставки" class="styler" type="text" name="address" required/>
			<input placeholder="Введите свою почту" class="styler" type="email" name="email" required/>
			<br/>
			<input type="submit" value="Сделать заказ"/>
		</div>
	</form>
<?
	bottom();
?>