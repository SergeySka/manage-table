<?php 
$pdo = new PDO("mysql:host=localhost;dbname=neto; charset=utf8", "root","");
$show = "SHOW TABLES";
if (isset($_GET['table'])) {
	$param = $_GET['table'];
	$describe = "DESCRIBE ".$param;
	if (isset($_GET['line'])) {
		$del = "ALTER TABLE " . $param . " DROP COLUMN " . $_GET['line'];
		$d = $pdo->prepare($del);
		$d->execute();
		$delLine = $d->fetchAll(PDO::FETCH_ASSOC);
	}
	if (isset($_POST)) {
		if (empty($_POST['name'])) {
			$_POST['name'] = $_POST['oldName'];
		}
		$change = "ALTER TABLE " . $param . " CHANGE " . $_POST['oldName'] . " " . $_POST['name'] . " " . $_POST['type'];
		$ch = $pdo->prepare($change);
		$ch->execute();
		$changeTable = $ch->fetchAll(PDO::FETCH_ASSOC);
	}
}
$stmt = $pdo->prepare($show);
$stmt->execute();
$tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
$st = $pdo->prepare($describe);
$st->execute();
$descr = $st->fetchAll(PDO::FETCH_ASSOC);
?>
 <!doctype html>
 <html lang="ru">
 <head>
 	<meta charset="UTF-8">
 	<title>Document</title>
 </head>
 <body>
 	<ul>
<?php foreach ($tables as $row) { 
	foreach ($row as $value) { ?>
	<li><a href="describe.php?table=<?=$value ?>"><?=$value ?></a></li>
	<?php } }?>
	</ul>
<?php if (!empty($descr)) { ?>
	<table cellpadding="10px" border="1px solid black">
		<thead>
			<th>Имя</th>
			<th>Тип</th>
			<th>Удалить поле</th>
		</thead>
<?php	foreach ($descr as $type) {	?>
		<tr>
			<td><?=$type['Field'] ?></td>
			<td><?=$type['Type'] ?></td>
			<td><a href="describe.php?table=<?=$param."&line=".$type['Field'] ?>">X</a></td>
		</tr>
<?php } ?>
	</table>
	<p>Внести изменения в таблицу <?=$_GET['table'] ?></p>
	<form action="describe.php?table=<?=$param ?>" method="POST">
		<input type="text" name="oldName" placeholder="Введите изменяемое имя" required>
		<input type="text" name="name" placeholder="Введите новое имя">
		<input type="text" name="type" placeholder="Введите новый тип" required>
		<input type="submit">
	</form>
<?php } ?>	
 </body>
 </html>
